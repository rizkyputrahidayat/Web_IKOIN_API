<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_atm = \App\Atm::all();
        return view('atm.index', compact('data_atm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        \App\Atm::create($request->all());
        return redirect('/nasabahatm')->with('sukses', 'Data ATM Berhasil DiTambahkan');
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
    public function edit($id_atm)
    {
        $atm = \App\Atm::find($id_atm);
        return view('atm.edit', compact('atm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_atm)
    {
        $atm = \App\Atm::find($id_atm);
        $atm->update($request->all());
        return redirect('/nasabahatm')->with('sukses', 'Data Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id_atm)
    {
        $atm = \App\Atm::find($id_atm);
        $atm->delete();
        return redirect('/nasabahatm')->with('sukses', 'Data Berhasil diHapus');
    }
}
