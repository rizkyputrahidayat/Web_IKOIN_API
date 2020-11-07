<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NasabahResource extends JsonResource
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
            'user_id' => $this->user_id,
            'nama' => $this->nama,
            'avatar' => $this->avatar,
            'alamat' => $this->alamat,
            'tgl_lahir' => $this->tgl_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nama_ibu' => $this->nama_ibu,
            'email' => $this->email,
            'created_at' => $this->created_at
        ];
    }
}
