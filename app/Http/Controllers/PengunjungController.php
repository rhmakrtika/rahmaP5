<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Storage;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengunjung = Pengunjung::latest()->paginate(5);
        return view('pengunjung.index', compact('pengunjung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengunjung.create');
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
            'nama' => 'required|min:5',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $pengunjung = new Pengunjung();
        $pengunjung->nama = $request->nama;
        $pengunjung->no_telepon = $request->no_telepon;
        $pengunjung->alamat = $request->alamat;
        // upload image
        $pengunjung->save();
        return redirect()->route('pengunjung.index');
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
        $pengunjung = Pengunjung::findOrFail($id);
        return view('pengunjung.edit', compact('pengunjung'));
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
            'nama' => 'required|min:5',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->nama = $request->nama;
        $pengunjung->no_telepon = $request->no_telepon;
        $pengunjung->alamat = $request->alamat;
        // upload image
        $pengunjung->save();
        return redirect()->route('pengunjung.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        Storage::delete('public/pengunjungs/' . $pengunjung->image);
        $pengunjung->delete();
        return redirect()->route('pengunjung.index');
    }
}
