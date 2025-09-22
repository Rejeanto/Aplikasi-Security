<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public $response = ['success' => false, 'msg' => ''];

  public $validationErrors = [
    'required'        => ':attribute harus diisi.',
    'email'           => ':attribute harus merupakan format email yang valid.',
    'numeric'         => ':attribute harus berisi angka numerik.',
    'min'             => ':attribute wajib diisi minimal :min.',
    'password.min'    => ':attribute minimal :min karakter.',
    'maxlength'       => ':attribute tidak boleh lebih dari :param karakter.',
    'unique'          => ':attribute sudah ada.',
    'same'            => ':attribute harus sama dengan :other.',
    'digits_between'  => ':attribute harus berada di antara :min dan :max digit',
    'gte'             => ':attribute harus lebih besar/sama dengan :value.',
    'lte'             => ':attribute harus lebih kecil/sama dengan :value.',
    'date'            => ':attribute harus berupa format tanggal yang valid.',
    'after_or_equal'  => ':attribute harus sama dengan/setelah :date',
    'before_or_equal' => ':attribute harus sama dengan/sebelum :date',
    'exists'          => ':attribute tidak terdaftar di database'
  ];
}
