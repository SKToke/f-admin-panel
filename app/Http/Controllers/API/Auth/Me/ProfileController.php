<?php

namespace App\Http\Controllers\API\Auth\Me;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\API\Auth\Me\CheckPasswordRequest;
use App\Http\Requests\API\Auth\Me\UpdateProfileRequest;
use App\Http\Requests\API\Auth\Me\ChangeEmailRequest;
use App\Http\Resources\Profiles\ProfileResource;
use App\Models\User;
use App\Notifications\VerifyEmail;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Carbon;

class ProfileController extends BaseController
{
    public function __construct(private JwtService $jwtService)
    {
    }

    /**
     * Update user's profile
     *
     * @param UpdateProfileRequest $request
     * @return Response|JsonResponse
     */
    public function update(UpdateProfileRequest $request): Response|JsonResponse
    {
        try {
            /** @var User $user */
            $thisUser = auth()->user();

            [$response, $message] = $this->updateWithAttributes($thisUser, array_filter($request->validated()));

            return $this->sendResponse(new ProfileResource($response), $message);
        } catch (Exception $exception){
            Log::error($exception);

            return $this->sendError("Server Error");
        }
    }

    /**
     * @param $thisUser
     * @param array $attributes
     * @return array
     * @throws Exception
     */
    public function updateWithAttributes($thisUser ,array $attributes): array
    {
        $thisUser->fill(Arr::except($attributes, ['email']));
        $sendMailVerificationAt = now();
        $thisUser->send_email_verification_code_at = $sendMailVerificationAt;

        $thisUser->save();

        if (isset($attributes['email']) && $thisUser->email != $attributes['email']) {
            $thisUser->email_verified_at = null;

            //generate token
            $jwtToken = $this->jwtService->generateJwtToken([
                'email' => $attributes['email'],
                'user_id' => $thisUser->id,
                'exp' => now()->timestamp,
                'send_email_verification_code_at' => $sendMailVerificationAt
            ]);

            $thisUser->notify(new VerifyEmail($jwtToken));

            return [$thisUser, __('messages.confirm_change_mail')];
        }

        return [$thisUser, __('auth.update_success', ['attribute' => __('global.profile')])];
    }

    /**
     * verify token and update email
     *
     * @param ChangeEmailRequest $request
     * @return Response|JsonResponse
     */
    public function updateEmail(ChangeEmailRequest $request): Response|JsonResponse
    {
        try{
            [$status, $payload] = $this->jwtService->verifyJwtToken($request->get('token'));

            if($status){
                $user = User::findOrFail($payload['user_id']);
                $payloadTime = Carbon::parse($payload['send_email_verification_code_at'])->format('Y-m-d H:s:i');
                $serveTime = Carbon::parse($user->send_email_verification_code_at)->format('Y-m-d H:s:i');

                if($payloadTime === $serveTime){
                    $user->email = $payload['email'];
                    $user->send_email_verification_code_at = null;
                    $user->save();

                    return $this->sendResponse(null, __('messages.update_mail_success'));
                }
            }

            return $this->sendError('something wrong');

        } catch (Exception $exception){
            Log::error($exception);

            return $this->sendError("Server Error");
        }
    }

    /**
     * Check valid password before deleting user
     *
     * @param CheckPasswordRequest $request
     * @return JsonResponse|Response
     */
    public function checkValidPassword(CheckPasswordRequest $request): Response|JsonResponse
    {
        try{
            if(!Hash::check(auth()->user()->getAuthPassword(), $request->get('password'))){
                return $this->sendError(__('auth.password'));
            }

            return response()->json(['success' => true]);
        } catch (Exception $exception){
            Log::error($exception);

            return $this->sendError("Server Error");
        }
    }

    /**
     * Delete user
     *
     * @param CheckPasswordRequest $request
     * @return Response|JsonResponse
     */
    public function destroy(CheckPasswordRequest $request): Response|JsonResponse
    {
        try{
            if(!Hash::check(auth()->user()->getAuthPassword(), $request->get('password'))){
                return $this->sendError(__('auth.password'));
            }
            auth()->user()->delete();

            return response()->json(['success' => true]);
        } catch (Exception $exception){
            Log::error($exception);

            return $this->sendError("Server Error");
        }
    }
}
