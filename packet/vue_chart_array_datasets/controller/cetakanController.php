<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dataCetakan;
use Illuminate\Support\Facades\DB;

class cetakanController extends Controller
{
    public function index()
    {
        $data = dataCetakan::orderBy('created_at', "DESC")->get();
      
        return response()->json([
            "status" => "sukses",
            "data" => $data
        ]);
    }

 
}



