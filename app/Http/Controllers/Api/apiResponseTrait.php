<?php 

namespace App\Http\Controllers\Api;

use App\Models\Sections;

trait   ApiResponseTrait{

    public function apiResponse($data = null , $msg = null , $status = null){
            $array = [
                'data' => $data ,
                'message' => $msg ,
                'status' => $status ,
            ];

            return response($array , $status);
    }
    
}