@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
            <img src="{{ url('images/logo.png') }}" class="rounded mx-auto d-block" width="200" alt="">
        </div>

        <div class="row">
            @foreach ($barang->chunk(5) as $chunk)
                <div class="d-flex flex-row">
                    @foreach ($chunk as $i => $v)
                        <div class="card mt-4 mx-4" style="width: 15rem;">
                            <img src="{{ asset('images/'.$v->gambar_barang) }}" alt="" class="img-thumbnail" style="height: 200px;"> <!-- Adjust the height as needed -->
                            <div class="card-body">
                                <h6 class="card-title text-center mx-5"><strong>{{ $v->nama_barang }}</strong></h6>
                                <hr><br>
                                <p class="card-text">
                                    <strong>Merk :</strong> {{ $v->merk }} <br>
                                    <strong>Harga :</strong> Rp. {{ number_format($v->harga) }} <br>
                                    <strong>Stok :</strong> {{ $v->stok }} <br>
                                    <strong>Desc :</strong> {{ $v->keterangan }}
                                    <hr>
                                </p>
                                <br>
                                <a href="{{ url('pesan')}}/{{ $v->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i></i> PESAN</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
