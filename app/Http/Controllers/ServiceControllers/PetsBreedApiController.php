<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breed;

class PetsBreedApiController extends Controller
{
	public function index(Request $request)
    {
    	
    }
    
    public function getList()
    {
    	$data = Breed::where([['visible', '=' ,'Y']])->orderBy('breed', 'asc')->get();
        
        return response()->json([
            'data' => $data,
        ], 200);
    }
}
