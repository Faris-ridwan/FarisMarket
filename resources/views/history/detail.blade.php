@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-12">
        <a href="{{ url('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
    </div>
    <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
        </ol>
        </nav>
    </div>
    <div class="col-md-12">   
        <div class="card">
            <div class="card-body">
                <h3>Sukses Check out</h3>
                <h5>Pesanan anda sudah sukses di checkout selanjutnya untuk pembayaran silahkan ditransfer di rekening <strong>Dana : 0878-6608-6638 </strong> dengan nominal <strong> : <strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong></strong></h5>
            </div>
        </div>    
        <div class="card mt-2">
            <div class="card-body">
            <h3><i class="fa fa-shopping-cart"></i>Detail pemesanan</h3>
           @if(!empty($pesanan))
            <p align="right">Tanggal Pesan : {{$pesanan->tanggal}}</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Merk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                    @foreach ($pesanan_detail as $i => $v)
                        <tr>
                            <td>{{ $no++}}</td>
                            <td>
                                <img src="{{ asset('images/'.$v->barang->gambar_barang) }}" alt="..." width="100">
                            </td>
                            <td>{{ $v->barang->nama_barang }}</td>
                            <td>{{ $v->barang->merk }}</td>
                            <td>{{ $v->jumlah }}</td>
                            <td>Rp. {{ number_format($v->barang->harga) }}</td>
                            <td>Rp. {{ number_format($v->jumlah_harga) }}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" align="right"><strong>TOTAL HARGA :</strong></td>
                            <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="6" align="right"><strong>KODE UNIK :</strong></td>
                            <td><strong>Rp. {{ number_format($pesanan->kode) }}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="6" align="right"><strong>TOTAL YANG HARUS DIBAYAR :</strong></td>
                            <td><strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong></td>
                        </tr>

                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
   </div>
</div>
@endsection
