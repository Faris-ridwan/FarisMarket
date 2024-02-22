<?php

namespace App\Http\Controllers;
use App\barang;
use App\pesanan;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use App\pesanandetail;
use Alert;
use Illuminate\Http\Request;

class pesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index($id)
    {
        $barang = barang::where('id', $id)->first();

        return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
        $barang = barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stok
        if($request->jumlah_pesan > $barang->stok)
        {
            alert()->error('Pesanan Gagal', 'Eror');
            return redirect('pesan/' .$id);
        }

        //cek validasi
        $cek_pesanan = pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //simpan ke database
        if(empty($cek_pesanan))
        {
            $pesanan = new pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
    
        }
       
        //simpan ke pesanan detail
        $pesanan_baru = pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();

        if(empty($cek_pesanan_detail))
        {     
            $pesanan_detail = new pesanandetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        }else
        {
            $pesanan_detail = pesanandetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)-> first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesanan->update();

        alert()->success('Pesanan berhasil masuk keranjang', 'Succes');

        return redirect('check-out');
    }

    public function check_out()
    {
        $pesanan = pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_detail = [];
        if(!empty($pesanan))
        {
            $pesanan_detail = pesanandetail::where('pesanan_id', $pesanan->id)->get();
        }
        
        return view('pesan.check_out', compact('pesanan', 'pesanan_detail'));
    }

    public function delete($id)
    {
        $pesanan_detail = pesanandetail::where('id', $id)->first();

        $pesanan = pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        alert()->error('Pesanan Sukses dihapus', 'Hapus');
        return redirect('check-out');
    }   

    public function konfirmasi()
    {
        $pesanan = pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_detail = pesanandetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_detail as $pesanan_detail) {
            $barang = barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesanan_detail->jumlah;
            $barang->update();
        }

        alert()->success('Pesanan Berhail Checkout silahkan lanjutkan proses pembayaran', 'Succes');
        return redirect('history/'.$pesanan_id);
    }
}
