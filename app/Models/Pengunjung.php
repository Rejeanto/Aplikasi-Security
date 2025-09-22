<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
  protected $table = 'pengunjung';
  protected $guarded = [];

  public function lokasi()
  {
    return $this->hasOne(LokasiKerja::class, 'id', 'lokasi_kerja');
  }
}
