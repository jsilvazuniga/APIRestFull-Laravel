<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\ApiResponser;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponser;

    public function transformAndValidatedRequest($transformer, $request, $rules){
        $transformedRules = $this->transformData($transformer, $rules);
        $data = $request->validate($transformedRules);

        $originalData = $this->transformData($transformer, $data, true);

        return $originalData;
    }

    public function transformData( $transformer, $data, $invert = false){
        $transformerData = [];

        foreach ($data as $attribute => $value) {
          $transformerData[$transformer::mapAttribute($attribute, $invert)] = $value;
        }

        return $transformerData;
    }
}
