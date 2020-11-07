<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tabungan;
use App\token_generator;

class Atm extends Model
{
    protected $table = 'atm';
    protected $primaryKey = 'id_atm';
    protected $fillable = ['nama_atm', 'alamat', 'keterangan'];

    public function tabungan()
    {
        return $this->hasMany(Tabungan::class, 'id_atm', 'id_atm');
    }
    public function token_generator()
    {
        return $this->belongsToMany(token_generator::class);
    }
}
