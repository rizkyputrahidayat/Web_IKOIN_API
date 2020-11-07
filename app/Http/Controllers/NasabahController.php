<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_nasabah = \App\Nasabah::all();
        return view('nasabah.index', compact('data_nasabah'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Insert ke TABLE USERS
        $user = new \App\User;
        $user->role = 'admin';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->id_nasabah = $request->id_nasabah;
        $user->password = bcrypt('admin');
        // $user->remember_token = str_random(60);
        $user->save();

        // Insert ketable nasabah
        $request->request->add(['user_id' => $user->id]);
        $nasabah = \App\Nasabah::create($request->all());
        $nasabah->save();
        // Insert Ke table Generate Token
        $request->request->add(['user_id' => $nasabah->id_nasabah]);
        \App\token_generator::create($request->all());
        return redirect('/nasabah')->with('sukses', 'Data Berhasil diinput');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $nasabah = \App\Nasabah::find($id);
        return view('nasabah.profile', compact('nasabah'));
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
        $nasabah = \App\Nasabah::find($id);
        return view('nasabah.edit', compact('nasabah'));
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
        $nasabah = \App\Nasabah::find($id);
        $nasabah->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $nasabah->avatar = $request->file('avatar')->getClientOriginalName();
            $nasabah->save();
        }
        return redirect('/nasabah')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $nasabah = \App\Nasabah::find($id);
        $nasabah->delete();
        return redirect('/nasabah')->with('sukses', 'Data Berhasil diHapus');
    }
}
