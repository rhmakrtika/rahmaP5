<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Pengunjung;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Storage;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservasi = Reservasi::latest()->paginate(5);
        return view('reservasi.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengunjung =  Pengunjung::all();
        $destinasi = Destinasi::all();
        return view('reservasi.create', compact('pengunjung', 'destinasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validate form
         $this->validate($request, [
            'tanggal_reservasi' => 'required',
            'jumlah_orang' => 'required',
        ]);

        $reservasi = new Reservasi();
        $reservasi->tanggal_reservasi = $request->tanggal_reservasi;
        $reservasi->jumlah_orang = $request->jumlah_orang;
        $reservasi->id_pengunjung = $request->id_pengunjung;
        $reservasi->id_destinasi = $request->id_destinasi;
        // upload image
        $reservasi->save();
        return redirect()->route('reservasi.index');
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
        $pengunjung =  Pengunjung::all();
        $destinasi = Destinasi::all();
        $reservasi = Reservasi::findOrFail($id);
        return view('reservasi.edit', compact('reservasi','pengunjung','destinasi'));
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
        $this->validate($request, [
            'tanggal_reservasi' => 'required',
            'jumlah_orang' => 'required',
        ]);

        $reservasi = reservasi::findOrFail($id);
        $reservasi->tanggal_reservasi = $request->tanggal_reservasi;
        $reservasi->jumlah_orang = $request->jumlah_orang;
        $reservasi->id_pengunjung = $request->id_pengunjung;
        $reservasi->id_destinasi = $request->id_destinasi;
        // upload image
        $reservasi->save();
        return redirect()->route('reservasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        Storage::delete('public/reservasis/' . $reservasi->image);
        $reservasi->delete();
        return redirect()->route('reservasi.index');
    }
}
