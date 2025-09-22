<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SoalResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id'      => $this->id,
      'soal'    => $this->soal,
      'poin'    => $this->poin,
      'pilihan' => $this->pilihan_jawaban->shuffle()->values()
    ];
  }
}
