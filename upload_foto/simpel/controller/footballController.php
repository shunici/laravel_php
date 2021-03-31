<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\football;
use File;
use Illuminate\Support\Facades\Storage;

class footballController extends Controller
{
    public function index()
    {        
        $data = football::all();
        return response()->json(["pesan" => "berhasil", "data" => $data]);
    }



    public function upload(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|mimes:png,jpg,jpeg',
            // 'nama' => 'required',
            // 'klub' =>
        ]);
        
        $file = null;
        if($request->hasFile('foto')){                        
            $file =  $this->simpan_foto( $request->file('foto') );  
            
            $input = $request->all();
            $input['foto'] = $file;
            football::create($input);
        }
        return response()->json([
            "pesan" => $file
        ]); 

        
    }

    private function simpan_foto($file)
    {
        $fileName = 'shuni'. time() .'.'. $file->getClientOriginalExtension();
        $file->storeAs('public/foto', $fileName);
        return $fileName;
    }

    public function delete ($id)
    {
        $data = football::findOrFail($id); 
        Storage::disk('public')->delete('/foto/'. $data->foto);
        $data->delete();     
        return response()->json([
            "data" => 'berhasill'
        ]);
    }    
}
