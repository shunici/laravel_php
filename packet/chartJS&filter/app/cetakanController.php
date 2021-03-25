<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dataCetakan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\dataCetakanExport;


class cetakanController extends Controller
{
    public function index()
    {
     
       $filter = request()->year . '-' . request()->month; //get data bulan & tahun dengan format penulisan 2021-03 yang dikirim dari url sebagai  parameter 
        $parse = Carbon::parse($filter); //ubah format menjadi format carbon (2021-03-31T23:59:59.999999Z)
        
        //buat range total pada bulan terkait
        $array_tanggal = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d')); 

        //ambil datacetakan berdasarkan tanggal $filter,  //SUM DATA total DAN SIMPAN KE NAMA BARU YAKNI TOTAL sama dengan create_at
        // ke nama baru yaitu date kemudian
        //GROUP / KELOMPOKKAN BERDASARKAN TANGGALNYA
       
    $dataCetakan = dataCetakan::select(DB::raw('date(created_at) as date,sum(total) as total'))
    ->where('created_at', 'LIKE', '%' . $filter . '%')
    ->groupBy(DB::raw('date(created_at)'))->get();
    //$data_array kosong ini sebagai wadah pada looping foreach yang menerima date dan total
    $data_array = [];
     //LOOPING RANGE TANGGAL BULAN SAAT INI
        foreach($array_tanggal as $row) {
            //jika tanggal dengan angka satu dijid
            $f_date = strlen($row) == 1 ? 0 . $row:$row;
            //BUAT FORMAT TANGGAL YYYY-MM-DD
            $date = $filter . '-' . $f_date;
            //CARI DATA BERDASARKAN $DATE PADA COLLECTION HASIL QUERY kemudian pindahkan ke data_array di dalam 
            $total = $dataCetakan->firstWhere('date', $date);

            $data_array [] = [
                'date' => $date,
                'total' => $total ? $total->total: 0,
            ];
        }    
            //kirim $data_array lewat data dan berikan pesan status berhasil
        return response()->json([
            "status" => $dataCetakan,
            "data" => $data_array
        ]);
    }

    public function exportData(Request $request)
    {
        $filter = request()->year . '-' . request()->month;
        $parse = Carbon::parse($filter);
        

    $array_tanggal = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));
    $dataCetakan = dataCetakan::select(DB::raw('date(created_at) as date,sum(total) as total'))
    ->where('created_at', 'LIKE', '%' . $filter . '%')
    ->groupBy(DB::raw('date(created_at)'))->get();
    $data_array = [];
     //LOOPING RANGE TANGGAL BULAN SAAT INI
        foreach($array_tanggal as $row) {
            //jika tanggal dengan angka satu dijid
            $f_date = strlen($row) == 1 ? 0 . $row:$row;
            //BUAT FORMAT TANGGAL YYYY-MM-DD
            $date = $filter . '-' . $f_date;
            //CARI DATA BERDASARKAN $DATE PADA COLLECTION HASIL QUERY kemudian pindahkan ke data_array di dalam 
            $total = $dataCetakan->firstWhere('date', $date);

            $data_array [] = [
                'date' => $date,
                'total' => $total ? $total->total: 0,
            ];
        }    
           
       
        return Excel::download(new dataCetakanExport($data_array, request()->month, request()->year), 'dataCetakan.xlsx');
    }
}





// public function exportData(Request $request)
// {
    
//     $dataCetakan = $this->index();
//     return Excel::download(new dataCetakanExport($dataCetakan, request()->month, request()->year), 'dataCetakan.xlsx');
// }