<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tabungan;
use App\token_generator;

class Nasabah extends Model
{
    protected $table = 'nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $fillable = ['nama', 'alamat', 'tgl_lahir', 'jenis_kelamin', 'nama_ibu', 'email', 'avatar', 'user_id'];
    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }
        return asset('images/' . $this->avatar);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function tabungan()
    {
        return $this->hasMany(Tabungan::class, 'id_nasabah', 'id');
    }
    public function tabungan1()
    {
        return $this->hasMany(Tabungan::class, 'id_penerima', 'id');
    }
    public function tabungan2()
    {
        return $this->hasMany(Tabungan::class, 'id_pengirim', 'id');
    }
    public function token_generator()
    {
        return $this->hasMany(token_generator::class, 'nasabah_id', 'id_nasabah');
    }
}
