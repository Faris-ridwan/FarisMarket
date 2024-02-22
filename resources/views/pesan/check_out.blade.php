@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-12">
        <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
    </div>
    <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
        </nav>
    </div>
    <div class="col-md-12">       
        <div class="card">
            <div class="card-body">
            <h3><i class="fa fa-shopping-cart"></i>Checkout</h3>
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
                            <th>AKSI</th>
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
                            <td>
                                <form action="{{ url('check-out') }}/{{ $v->id }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin Hapus ?');"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" align="right"><strong>TOTAL HARGA :</strong></td>
                            <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                            <td>
                                @if(count($pesanan_detail) > 0)
                                <a href="{{ url('konfirmasi-check-out') }}" class="btn btn-success" onclick="return confirm('Anda yakin ingin check out ?');"><i class="fa fa-shopping-cart"></i>Checkout</a>
                                @else
                                <button class="btn btn-success" disabled><i class="fa fa-shopping-cart"></i>Checkout</button>
                                @endif
                            </td>
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
