<?php

namespace App\Http\Controllers;



use App\Models\Reservasi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Storage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::latest()->paginate(5);
        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservasi = Reservasi::all();
        $transaksi = Transaksi::all();
        return view('transaksi.create', compact('transaksi','reservasi'));
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
            'metode_pembayaran' => 'required',
            'jumlah_pembayaran' => 'required',
            'tanggal_transaksi' => 'required',
        ]);

        $transaksi = new Transaksi();
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->jumlah_pembayaran = $request->jumlah_pembayaran;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->id_reservasi = $request->id_reservasi;
        // upload image
        $transaksi->save();
        return redirect()->route('transaksi.index');
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
        $reservasi = Reservasi::all();
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi','reservasi'));
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
            'metode_pembayaran' => 'required',
            'jumlah_pembayaran' => 'required',
            'tanggal_transaksi' => 'required',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->jumlah_pembayaran = $request->jumlah_pembayaran;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->id_reservasi = $request->id_reservasi;
        // upload image
        $transaksi->save();
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        Storage::delete('public/transaksis/' . $transaksi->image);
        $transaksi->delete();
        return redirect()->route('transaksi.index');
    }
}
