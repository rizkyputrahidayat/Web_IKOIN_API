<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NasabahPackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_transaksi' => 'required|string|in:SETORAN,TRANSFER,PENARIKAN,MERCHANT',
            'mode_transaksi' => 'required|string|in:ATM,HP,MERCHANT'
        ];
    }
}
