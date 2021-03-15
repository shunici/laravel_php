<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\football;
class footballController extends Controller
{
    public function index()
    {        
        $data = football::all();
        return response()->json(["pesan" => "berhasil", "data" => $data]);
    }

    public function create (Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'klub' => 'required',
            'nomor_punggung' => 'numeric'
        ]);
         $data = football::create($request->all());
         return response()->json(['pesan' => 'berhasil'], 200);
    }

    public function edit ($id)
    {
        $data = football::findOrFail($id);
        return response()->json(['pesan' => 'berhasil', 'data' => $data]);
    }

    public function update (Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'klub' => 'required',
            'nomor_punggung' => 'numeric'
        ]);
        $data = football::findOrFail($id);
        $data->update($request->all());
        return response()->json(['pesan' => 'success'], 200);
    }

    public function delete ($id)
    {
        $data = football::findOrFail($id);
        $data->delete();
        return response()->json(['pesan' => 'success'], 200);
    }
}
