<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\SectionResource;
use App\Models\Sections;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;

class SectionController extends Controller
{   
    use ApiResponseTrait;
    public function index(){
         $sections = SectionResource::collection(Sections::get());  
         
         return $this->apiResponse($sections,'ok',200);
    }
    public function show($id){
        $sections = Sections::find($id);
        if($sections){
            return $this->apiResponse( new SectionResource($sections),"ok", 200);

        }
        return $this->apiResponse(  null  , "Not Found" , 404 );
    }

    public function store(Request $request){
        $validator = FacadesValidator::make($request->all(),[
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        


        $section = Sections::create($request->all());
        if($section){
            return $this->apiResponse(new SectionResource($section),"OK" , 201);
        }
        return $this->apiResponse(null,'section not saved' , 400 );
    }


    public function update(Request $request , $id){
        $validator = FacadesValidator::make($request->all(),[
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        

            $section = Sections::find($id);
            $section->update($request->all());
            if($section){
                return $this->apiResponse(new SectionResource($section),"Section Updated" , 201);
            }
            return $this->apiResponse(null,'The post not found ', 404);
        
    }
}
