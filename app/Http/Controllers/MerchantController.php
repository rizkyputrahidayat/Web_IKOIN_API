<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\User_Merchant;
use App\Http\Resources\MerchantResource;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_merchant = \App\Merchant::all();
        return view('merchant.index', compact('data_merchant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Insert ke TABLE USERS
        $user_merchant = new \App\User_Merchant;
        $user_merchant->name = $request->name;
        $user_merchant->email = $request->email;
        $user_merchant->username = $request->username;
        $user_merchant->password = bcrypt($request->password);
        $user_merchant->alamat = $request->alamat;
        $user_merchant->save();
        $request->request->add(['merchant_id' => $user_merchant->id_merchant]);
        \App\Merchant::create($request->all());
        return redirect('/merchant')->with('sukses', 'Data Berhasil DiTambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id_merchant)
    {
        $merchant = \App\Merchant::find($id_merchant);
        $merchant->delete();
        return redirect('/merchant')->with('sukses', 'Data Berhasil diHapus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
