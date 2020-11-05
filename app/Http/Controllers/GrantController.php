<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grant;
use App\Http\Requests\GrantStoreRequest;

class GrantController extends Controller
{

    public function fetchAllGrants()
    {
        $grants = Grant::all();
        return $grants;
    }

    public function getGrant($id)
    {
        $grant = Grant::findOrFail($id);  

        return $grant;
    }

    public function createGrant(GrantStoreRequest $request){
        
        $grant = Grant::create($request->all());
            
        return $grant;
      
    }

    public function updateGrant(Request $request, $id){

        if( empty($request->getContent()) ){

            return [
                "message" => "Provide a valid request body"
            ];

        } else {
            $grant = Grant::findOrFail($id);  
        
            $grant->update($request->all());
    
            return $grant;
        }
   
    }

    public function deleteGrant(Request $request, $id){
        $grant = Grant::findOrFail($id);

        $grant->delete();

        return $grant;
    }

}
