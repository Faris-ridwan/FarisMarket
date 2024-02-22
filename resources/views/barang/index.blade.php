@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="col-md-12">
        <a href="{{route('barang.create')}}" class="btn btn-primary" enctype="multipart/form-data"><i class="fa fa-plus"></i></a>
        <a href="{{url('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
    </div>
<div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
        </nav>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Gambar Produk</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            @foreach ($barang as $i => $v)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $v->nama_barang }}</td>
                                <td>
                                    <img src="{{asset('images/'.$v->gambar_barang)}}" alt="" style="width: 100px">
                                </td>
                                <td>{{ $v->merk}}</td>
                                <td>{{ $v->harga}}</td>
                                <td>{{ $v->stok}}</td>
                                <td>{{ $v->keterangan }}</td>
                                <td>
                                    <form action="{{ route('barang.destroy', $v->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('barang.edit', $v->id) }}"
                                            class="btn btn-warning btn-sm">EDIT</a>
                                        <button class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
