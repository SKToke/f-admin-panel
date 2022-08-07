<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords {
        sendResetResponse as baseSendResetResponse;
        sendResetFailedResponse as baseSendResetFailedResponse;
        rules as baseRules;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function sendResetResponse(Request $request, $response): JsonResponse
    {
        $this->baseSendResetResponse($request, $response);

        $user = User::where('email', $request->input('email'))->first();

        return response()->json([
            'token' => $user->createToken($request->input('device_name'))->plainTextToken,
        ]);
    }

    protected function sendResetFailedResponse(Request $request, $response): JsonResponse
    {
        $this->baseSendResetFailedResponse($request, $response);

        return response()->json([
            'message' => $response,
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * @param  CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password): void
    {
        $user->password = bcrypt($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }

    protected function rules(): array
    {
        return array_merge($this->baseRules(), [
            'device_name' => ['required'],
            'password' => [
                'required',
                'string',
                'between:1,50',
                'confirmed',
            ],
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @unauthenticated
     * @group Guest
     */
    public function reset(Request $request): JsonResponse
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    public function checkResetLink(Request $request): JsonResponse
    {
        if (is_null($this->broker()->getUser($request->all()))) {
            return response()->json([
                'valid' => false,
            ]);
        }

        return response()->json([
            'valid' => true,
        ]);

    }
}
