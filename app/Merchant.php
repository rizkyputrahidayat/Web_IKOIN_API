<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tabungan;
use App\User_Merchant;

class Merchant extends Model
{
    protected $table = 'merchant';
    protected $primaryKey = 'id_merchant';
    protected $fillable = ['merchant_id', 'nama', 'alamat', 'email', 'keterangan'];

    public function user_merchant()
    {
        return $this->belongsTo(User_Merchant::class, 'merchant_id', 'id_merchant');
    }
    public function tabungan()
    {
        return $this->hasMany(Tabungan::class, 'id_merchant', 'id_merchant');
    }
}
