<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $limit = isset($input['perpage']) ? $input['perpage'] : 20;
        $results = [];
        try {
            $results = User::whereNull('users.deleted_at')
                ->with('roles')
                ->paginate($limit)
                ->toArray();
        } catch (\Throwable $e) {
            return $this->sendError('User Not Found!');
        }
        $metadata = null;
        if (count($results) > 0) {
            $metadata = $this->resMetaData($results);
        }
        return $this->sendResponse(
            UserResource::collection(
                json_decode(json_encode($results['data']), false)
            ),
            'success',
            $metadata
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailUser($id)
    {
        $results = [];
        try {
            $results = User::whereNull('users.deleted_at')
                ->where('users.id', $id)
                ->with(['roles', 'country'])
                ->get()
                ->toArray();
        } catch (\Throwable $e) {
        }

        if (empty($results[0])) {
            return $this->sendError('User Not Found!');
        }

        $fullname = [];
        $results = json_decode(json_encode($results[0]), false);
        $first_name = isset($results->first_name) ? $results->first_name : '';
        $last_name = isset($results->last_name) ? $results->last_name : '';
        $results->full_name = trim($first_name . ' ' . $last_name);

        return $this->sendResponse(new UserResource($results), 'success');
    }

    /**
     * SEARCH USER BY FULL NAME
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)
    {
        $input = $request->all();
        $limit = isset($input['perpage']) ? $input['perpage'] : 20;

        $search = trim($input['search']);
        if (is_null($search)) {
            return $this->sendError('search invalid.');
        }
        $results = [];
        try {
            $results = User::where('email', 'LIKE', '%' . $search . '%')
                ->orWhere(
                    DB::raw("CONCAT(users.first_name,' ',users.last_name)"),
                    'LIKE',
                    '%' . $search . '%'
                )
                ->whereNull('users.deleted_at')
                ->with(['roles', 'country'])
                ->paginate($limit)
                ->toArray();
        } catch (\Throwable $e) {
        }

        if (empty($results)) {
            return $this->sendError('User Not Found!');
        }

        $metadata = null;
        if (count($results) > 0) {
            $metadata = $this->resMetaData($results);
        }

        return $this->sendResponse(
            UserResource::collection(
                json_decode(json_encode($results['data']), false)
            ),
            'success',
            $metadata
        );
    }
}
