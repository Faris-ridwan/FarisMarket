<?php

namespace App\Http\Controllers;
use App\barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = barang::orderBy('created_at', 'DESC')->paginate(10);

        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = barang::all();
        return view('barang.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang'         => 'required',
            'gambar_barang'       => 'required|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'merk'                => 'required',
            'harga'               => 'required',
            'stok'                => 'required',
            'keterangan'          => 'required',

        ]);

        $gambar=$request->file('gambar_barang');
        $imageName=date('Y-m-d') . '_' . time(). '.' .$gambar->extension();

        $gambar->move(public_path('images'), $imageName);

        barang::create([
            'nama_barang'   => $request->nama_barang,
            'gambar_barang' => $imageName,
            'merk'          => $request->merk,
            'harga'         => $request->harga,
            'stok'          => $request->stok,
            'keterangan'    => $request->keterangan

        ]);

        return redirect(route('barang.index'))->with(['succes' => 'barang berhasil di tambah']);
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
        $barang = barang::find($id);
        return view('barang.edit', compact('barang'));
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
        $this->validate($request,[
            'nama_barang'         => 'required',
            'merk'                => 'required',
            'harga'               => 'required',
            'stok'                => 'required',
            'keterangan'          => 'required',
        ]);
        
        // Jika ada file gambar yang diunggah, proses pemindahan gambar
        if ($request->hasFile('gambar_barang')) {
            $image = $request->file('gambar_barang');
            $imageName = date('y-m-d') . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            // Jika tidak ada file gambar yang diunggah, gunakan gambar yang sudah ada
            $imageName = barang::find($id)->gambar;
        }
        
        $barang = barang::find($id);
        $barang->update([
            'nama_barang'       => $request->nama_barang,
            'gambar_barang'     => $imageName,
            'merk'              => $request->merk,
            'harga'             => $request->harga,
            'stok'              => $request->stok,
            'keterangan'        => $request->keterangan
        ]);

        return redirect(route('barang.index'))->with(['Success'=>'barang berhasil diperbarui']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        barang::where('id', $id)->delete();

        return redirect(route('barang.index'))->with(['success' => 'barang Dihapus!']);
    }
}
