<?php

namespace App;

use App\Merchant;

use Illuminate\Database\Eloquent\Model;

class User_Merchant extends Model
{
    protected $table = 'users_merchant';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'username', 'password', 'alamat'];
    public function merchant()
    {
        return $this->hasMany(Merchant::class, 'merchant_id', 'id_merchant');
    }
}
