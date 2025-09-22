<?php

namespace App\Http\Controllers;

use App\Http\Resources\HasilTestResource;
use App\Http\Resources\SoalResource;
use App\Models\JawabanPengunjung;
use App\Models\LokasiKerja;
use App\Models\Pengunjung;
use App\Models\PilihanJawaban;
use App\Models\Soal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $soal = Soal::inRandomOrder()->get();
    $soal = SoalResource::collection($soal)->toArray(null);
    $lokasi = LokasiKerja::all();
    return view('home', [
      'soal'    => $soal,
      'lokasi'  => $lokasi
    ]);
  }

  public function daftar(Request $request)
  {
    $this->validate($request, [
      'nama'          => 'required',
      'email'         => 'required|email',
      'phone'         => 'required|numeric',
      'no_pekerja'    => 'required',
      'lokasi_kerja'  => 'required',
    ], $this->validationErrors, [
      'nama'          => 'Nama',
      'email'         => 'Email',
      'phone'         => 'Nomor HP',
      'no_pekerja'    => 'Nomor Pekerja',
      'lokasi_kerja'  => 'Lokasi Kerja',
    ]);

    $create = Pengunjung::create([
      'nama'          => $request->nama,
      'email'         => $request->email,
      'phone'         => $request->phone,
      'no_pekerja'    => $request->no_pekerja,
      'lokasi_kerja'  => $request->lokasi_kerja,
    ]);

    if ($create) {
      $this->response['msg'] = 'Berhasil!';
      $this->response['success'] = true;
      $this->response['pengunjung_id'] = $create->id;
    } else {
      $this->response['msg'] = 'Gagal!';
    }
    return response()->json($this->response, 200);
  }

  public function start_test(Request $request, $id)
  {
    $update = Pengunjung::where('id', $id)->update(['start_test' => Carbon::now()->toDateTimeString()]);
    if ($update) {
      $this->response['msg'] = 'Berhasil!';
      $this->response['success'] = true;
    } else {
      $this->response['msg'] = 'Gagal!';
    }
    return response()->json($this->response, 200);
  }

  public function submit_test(Request $request, $id)
  {
    try {
      Pengunjung::where('id', $id)->update(['end_test' => Carbon::now()->toDateTimeString()]);

      foreach ($request->id_soal as $soal) {
        JawabanPengunjung::create([
          'id_pengunjung'       => $id,
          'id_soal'             => $soal,
          'id_pilihan_jawaban'  => isset($request->{'pilihan_' . $soal}) ? $request->{'pilihan_' . $soal} : 0
        ]);
      }

      $jawabanPengunjung = JawabanPengunjung::where('id_pengunjung', $id);
      $jawabanBenar = PilihanJawaban::where('benar', 1);
      $pengunjung = Pengunjung::with('lokasi')->where('id', $id)->first();
      $pengunjung->jawaban = Soal::from('soal as s')
        ->joinSub($jawabanPengunjung, 'jp', 'jp.id_soal', 's.id')
        ->joinSub($jawabanBenar, 'pj', 'pj.soal_id', 's.id')
        ->selectRaw('s.id, s.soal, jp.id_pilihan_jawaban, if(jp.id_pilihan_jawaban = pj.id, 1, 0) as is_benar, if(jp.id_pilihan_jawaban = pj.id, s.poin, 0) as poin')
        ->get();

      foreach ($pengunjung->jawaban as $d) {
        $d->pilihan_jawaban = PilihanJawaban::where('soal_id', $d->id)->get();
      }

      $this->response['msg'] = 'Berhasil!';
      $this->response['success'] = true;
      $this->response['data'] = $pengunjung;
    } catch (\Exception $e) {
      $this->response['msg'] = $e->getMessage();
    }
    return response()->json($this->response, 200);
  }
}
