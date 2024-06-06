<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use Storage;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinasi = Destinasi::latest()->paginate(5);
        return view('destinasi.index', compact('destinasi'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('destinasi.create');
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
            'nama_destinasi' => 'required|min:5',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',

        ]);

        $destinasi = new Destinasi();
        $destinasi->nama_destinasi = $request->nama_destinasi;
        $destinasi->lokasi = $request->lokasi;
        $destinasi->deskripsi = $request->deskripsi;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/destinasis', $image->hashName());
        $destinasi->image = $image->hashName();
        $destinasi->save();
        return redirect()->route('destinasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destinasi = Destinasi::findOrFail($id);
      return view('destinasi.show', compact('destinasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        return view('destinasi.edit', compact('destinasi'));
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
            'nama_destinasi' => 'required|min:5',
            'lokasi' => 'required',
            'deskripsi' => 'required',
        ]);

        $destinasi = Destinasi::findOrFail($id);
        $destinasi->nama_destinasi = $request->nama_destinasi;
        $destinasi->lokasi = $request->lokasi;
        $destinasi->deskripsi = $request->deskripsi;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/destinasis', $image->hashName());
        //delete old image
        Storage::delete('public/destinasis/' . $destinasi->image);

        $destinasi->image = $image->hashName();
        $destinasi->save();
        return redirect()->route('destinasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destinasi = destinasi::findOrFail($id);
        Storage::delete('public/destinasis/' . $destinasi->image);
        $destinasi->delete();
        return redirect()->route('destinasi.index');
    }
}
