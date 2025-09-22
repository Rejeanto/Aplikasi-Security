<?php

namespace App\Http\Controllers;

use App\Models\PilihanJawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{
  function index()
  {
    return view('admin.soal')->with([
      'title' => 'Soal'
    ]);
  }

  function getData()
  {
    $data = Soal::with('pilihan_jawaban')->get();
    return response($data);
  }

  function update(Request $request, $id)
  {
    $data = Soal::with('pilihan_jawaban')->get();
    $validation = [];
    $attributes = [];

    foreach ($data as $d) {
      $validation['soal_' . $d->id] = 'required';
      $attributes['soal_' . $d->id] = 'Teks Soal';

      foreach ($d->pilihan_jawaban as $pil) {
        $validation['pilihan_' . $pil->id] = 'required';
        $attributes['pilihan_' . $pil->id] = 'Teks Pilihan Jawaban';
      }
    }

    $validator = Validator::make($request->all(), $validation, $this->validationErrors, $attributes);
    if ($validator->fails()) {
      return response()->json([
        'errors'  => $validator->errors(),
        'message' => 'The given data was invalid.'
      ], 422);
    }

    foreach ($data as $d) {
      Soal::where('id', $d->id)->update([
        'soal' => $request->{'soal_' . $d->id}
      ]);

      foreach ($d->pilihan_jawaban as $pil) {
        PilihanJawaban::where('id', $pil->id)->update([
          'pilihan' => $request->{'pilihan_' . $pil->id},
          'benar'   => $request->{'benar_' . $d->id} == $pil->id ? 1 : 0
        ]);
      }
    }
    $this->response['success'] = true;
    $this->response['msg'] = 'Berhasil!';
    return response()->json($this->response, 200);
  }
}
