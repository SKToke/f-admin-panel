<?php

namespace App\Http\Controllers\API\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Country;
use Validator;
use App\Http\Resources\CountryResource;
use Illuminate\Support\Facades\DB;

class CountryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListAllCountry(Request $request)
    {
        // $limit = isset($input['perpage']) ? $input['perpage'] : 20;

        $results = Country::whereNull('deleted_at')->get();
        return $this->sendResponse(
            CountryResource::collection(
                $results
            ),
            'success'
        );
    }

    public function getDetailCountry($id)
    {
        $product = Country::where('countries.id', $id)
            ->whereNull('deleted_at')
            ->get()
            ->toArray();

        if (empty($product[0])) {
            return $this->sendError('Countries not found.');
        }

        return $this->sendResponse(
            new CountryResource(json_decode(json_encode($product[0]), false)),
            'Success'
        );
    }
}
