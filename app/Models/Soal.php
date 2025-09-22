<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
  protected $table = 'soal';
  protected $guarded = [];

  public function pilihan_jawaban()
  {
    return $this->hasMany(PilihanJawaban::class, 'soal_id', 'id');
  }
}
