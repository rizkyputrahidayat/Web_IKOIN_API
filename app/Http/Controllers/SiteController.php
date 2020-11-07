<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('sites.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postregister(Request $request)
    {
        $user = new \App\User;
        $user->role = 'admin';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        // $user->id_nasabah = $request->id_nasabah;
        $user->password = bcrypt($request->password);
        // $user->remember_token = str_random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id]);
        $nasabah = \App\Nasabah::create($request->all());
        $nasabah->save();
        // Insert Ke table Generate Token
        $request->request->add(['user_id' => $user->id]);
        $request->request->add(['nasabah_id' => $nasabah->id_nasabah]);
        \App\token_generator::create($request->all());
        return redirect('/')->with('sukses', 'Data pendaftaran Berhasil Dikirim');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('sites.register');
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
