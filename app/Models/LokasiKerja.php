<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LokasiKerja extends Model
{
  use SoftDeletes;
  protected $table = 'lokasi_kerja';
  protected $guarded = [];
}
