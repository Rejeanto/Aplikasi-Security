<?php

namespace App\Http\Controllers;

use App\Models\JawabanPengunjung;
use App\Models\Pengunjung;
use App\Models\PilihanJawaban;
use App\Models\Soal;
use Illuminate\Http\Request;

class HasilController extends Controller
{
  function index()
  {
    return view('admin.hasil')->with([
      'title' => 'Hasil Test'
    ]);
  }

  function getData(Request $request)
  {
    $jawabanBenar = PilihanJawaban::where('benar', 1);
    if ($request->type == 'data') {
      $jawaban = Soal::from('soal as s')
        ->join('jawaban_pengunjung as jp', 'jp.id_soal', 's.id')
        ->joinSub($jawabanBenar, 'pj', 'pj.soal_id', 's.id')
        ->selectRaw('jp.id_pengunjung, jp.id_soal, if(jp.id_pilihan_jawaban = pj.id, 1, 0) as is_benar, if(jp.id_pilihan_jawaban = pj.id, s.poin, 0) as poin');

      $data = Pengunjung::from('pengunjung as p')
        ->join('lokasi_kerja as lk', 'lk.id', 'p.lokasi_kerja')
        ->joinSub($jawaban, 'cj', 'cj.id_pengunjung', 'p.id')
        ->selectRaw('p.id, p.nama, p.email, p.phone, p.no_pekerja, lk.lokasi_kerja, sum(cj.poin) as total_poin, p.start_test, p.end_test')
        ->groupBy('p.id', 'p.nama', 'p.email', 'p.phone', 'p.no_pekerja', 'lk.lokasi_kerja', 'p.start_test', 'p.end_test');

      if (isset($request->search) && $request->search != '') {
        $data = $data->where(function ($w) use ($request) {
          $w->where('p.nama', 'like', "%$request->search%")
            ->orWhere('p.email', 'like', "%$request->search%")
            ->orWhere('p.phone', 'like', "%$request->search%")
            ->orWhere('p.no_pekerja', 'like', "%$request->search%")
            ->orWhere('lk.lokasi_kerja', 'like', "%$request->search%");
        });
      }

      $data = $data->paginate($request->row_per_page);
    } else if ($request->type == 'detail') {
      $jawabanPengunjung = JawabanPengunjung::where('id_pengunjung', $request->id);
      $data = Soal::from('soal as s')
        ->joinSub($jawabanPengunjung, 'jp', 'jp.id_soal', 's.id')
        ->joinSub($jawabanBenar, 'pj', 'pj.soal_id', 's.id')
        ->selectRaw('s.id, s.soal, jp.id_pilihan_jawaban, if(jp.id_pilihan_jawaban = pj.id, 1, 0) as is_benar, if(jp.id_pilihan_jawaban = pj.id, s.poin, 0) as poin')
        ->get();

      foreach ($data as $d) {
        $d->pilihan_jawaban = PilihanJawaban::where('soal_id', $d->id)->get();
      }
    }
    return response()->json($data);
  }
}
