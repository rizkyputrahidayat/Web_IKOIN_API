<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nasabah;
use App\Atm;
use App\Merchant;

class Tabungan extends Model
{
    protected $primaryKey = 'id';
    protected $hidden = ['id', 'saldo', 'id_atm', 'keterangan', 'deleted_at', 'created_at', 'updated_at'];
    protected $fillable = ['id_nasabah', 'tanggal', 'id_penerima', 'id_pengirim', 'nominal_debit', 'nominal_kredit', 'saldo', 'keterangan', 'jenis_transaksi', 'id_atm', 'id_merchant', 'mode_transaksi'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah', 'id_nasabah');
    }
    public function nasabah1()
    {
        return $this->belongsTo(Nasabah::class, 'id_penerima', 'id_nasabah');
    }
    public function nasabah2()
    {
        return $this->belongsTo(Nasabah::class, 'id_pengirim', 'id_nasabah');
    }
    public function atm()
    {
        return $this->belongsTo(Atm::class, 'id_atm', 'id_atm');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'id_merchant', 'id_merchant');
    }
}
