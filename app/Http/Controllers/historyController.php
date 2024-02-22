<?php

namespace App\Http\Controllers;
use App\barang;
use App\pesanan;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use App\pesanandetail;
use Alert;
use Illuminate\Http\Request;

class historyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pesanan = pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();

        return view('history.index', compact('pesanan'));
    }

    public function detail($id)
    {
        $pesanan = pesanan::where('id', $id)->first();
        $pesanan_detail = pesanandetail::where('pesanan_id', $pesanan->id)->get();

        return view('history.detail', compact('pesanan', 'pesanan_detail'));
    }
}
