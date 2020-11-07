<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class history_api extends Model
{
    protected $table = 'history_api';
    protected $fillable = ['jenis_service', 'jenis_device', 'date', 'json_request', 'status_request', 'keterangan'];
}
