<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
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
            'id_merchant' => $this->id_merchant,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at
        ];
    }
}
