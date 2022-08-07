<?php

namespace App\Http\Controllers\API\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\Upload\UploadRequest;
use App\Models\Sport;
use Validator;
use App\Http\Resources\SportResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Response;

class UploadController extends BaseController
{
    public function upload(UploadRequest $uploadRequest)
    {
        $type = $uploadRequest->input('type');
        $model = new User();
        $collection = 'user_avatar';
        if ($type == 'event') {
            $model = new Event();
            $collection = 'event';
        }

        $model->id = 0;
        $model->exists = true;
        $media = $model->addMediaFromRequest('file')->toMediaCollection($collection);
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}
