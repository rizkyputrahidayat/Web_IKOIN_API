<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AtmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_atm' => $this->id_atm,
            'nama' => $this->alamat,
            'avatar' => $this->nama_atm,
            'alamat' => $this->keterangan,
            'created_at' => $this->created_at
        ];
    }
}
