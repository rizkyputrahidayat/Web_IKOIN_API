<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nasabah;
use App\Atm;
use App\User;

class token_generator extends Model
{
    protected $table = 'token_generator';
    protected $primaryKey = 'id';
    protected $fillable = ['id_nasabah', 'token', 'date_request', 'date_expired', 'id_atm', 'user_id', 'nasabah_id'];
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id', 'id_nasabah');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function atm()
    {
        return $this->belongsToMany(Atm::class);
    }
}
