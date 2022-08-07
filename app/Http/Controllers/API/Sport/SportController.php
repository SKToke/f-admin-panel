<?php

namespace App\Http\Controllers\API\Sport;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Sport;
use Validator;
use App\Http\Resources\SportResource;
use Illuminate\Support\Facades\DB;

class SportController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListAllSport(Request $request)
    {
        $input = $request->all();
        $limit = isset($input['perpage']) ? $input['perpage'] : 20;

        $results = Sport::whereNull('deleted_at')
            ->paginate($limit)
            ->toArray();
        $metadata = null;
        if (count($results) > 0) {
            $metadata = $this->resMetaData($results);
        }
        return $this->sendResponse(
            SportResource::collection(
                json_decode(json_encode($results['data']), false)
            ),
            'success',
            $metadata
        );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDetailSport($id)
    {
        $sport = Sport::where('sports.id', $id)
            ->whereNull('deleted_at')
            ->get()
            ->toArray();

        if (empty($sport[0])) {
            return $this->sendError('Sport not found.');
        }

        return $this->sendResponse(
            new SportResource(json_decode(json_encode($sport[0]), false)),
            'Sport retrieved successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Product $product)
    // {
    //     $product->delete();

    //     return $this->sendResponse([], 'Product deleted successfully.');
    // }
}
