<?php

namespace App\Http\Controllers;

use App\Models\LokasiKerja;
use Illuminate\Http\Request;

class LokasiKerjaController extends Controller
{
  public function index()
  {
    return view('admin.lokasi', [
      'title' => 'Lokasi Kerja'
    ]);
  }

  public function getData(Request $request)
  {
    $data = LokasiKerja::select('id', 'lokasi_kerja');
    if (isset($request->search) && $request->search != '') {
      $data = $data->where('lokasi_kerja', 'like', "%$request->search%");
    }
    return $data->paginate($request->row_per_page);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'lokasi_kerja'  => 'required',
    ], $this->validationErrors, [
      'lokasi_kerja'  => 'Lokasi Kerja',
    ]);

    $create = LokasiKerja::create(['lokasi_kerja' => $request->lokasi_kerja]);
    if ($create) {
      $this->response['msg'] = 'Berhasil!';
      $this->response['success'] = true;
    } else {
      $this->response['msg'] = 'Gagal!';
    }
    return response()->json($this->response, 200);
  }

  public function show($id)
  {
    $data = LokasiKerja::find($id);
    return response($data);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'lokasi_kerja'  => 'required',
    ], $this->validationErrors, [
      'lokasi_kerja'  => 'Lokasi Kerja',
    ]);

    $update = LokasiKerja::where('id', $id)->update(['lokasi_kerja' => $request->lokasi_kerja]);
    if ($update) {
      $this->response['msg'] = 'Berhasil!';
      $this->response['success'] = true;
    } else {
      $this->response['msg'] = 'Gagal!';
    }
    return response()->json($this->response, 200);
  }

  public function destroy($id)
  {
    $proc = LokasiKerja::where('id', $id)->delete();
    if ($proc) {
      $this->response['success'] = true;
      $this->response['msg'] = 'Berhasil!';
    } else {
      $this->response['msg'] = 'Gagal!';
    }
    return response()->json($this->response, 200);
  }
}
