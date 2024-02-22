@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('barang.update', $barang->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT"/>
                        <div class="mb-3">
                            <label for="gambar_barang">Gambar Barang</label>
                            <input type="file" name="gambar_barang" class="form-control" value= "{{$barang->gambar_barang}}">
                            <img src="{{asset('images/'.$barang->gambar_barang)}}" 
                            alt="" class="mt-3" style="width: 100px">
                            <p class="text-danger">{{ $errors->first('gambar_barang') }}</p>
                          </div>
                          <div class="mb-3">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value= "{{$barang->nama_barang}}" required>
                            <p class="text-danger">{{ $errors->first('nama_barang') }}</p>
                          </div>
                          <div class="mb-3">
                            <label for="harga">harga</label>
                            <input type="number" name="harga" class="form-control" value= "{{$barang->harga}}" required>
                            <p class="text-danger">{{ $errors->first('harga')}}</p>
                          </div>
                          <div class="mb-3">
                            <label for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control" value= "{{$barang->merk}}" required>
                            <p class="text-danger">{{ $errors->first('merk')}}</p>
                          </div>
                          <div class="mb-3">
                            <label for="stok">stok barang</label>
                            <input type="number" name="stok" class="form-control" value= "{{$barang->stok}}" required>
                            <p class="text-danger">{{ $errors->first('stok')}}</p>
                          </div>
                          <div class="mb-3">
                            <label for="keterangan">keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{$barang->keterangan}}" required>
                            <p class="text-danger">{{ $errors->first('keterangan')}}</p>
                          </div>
                          <button class="btn btn-primary btn-large">Simpan</button>
                         <a href="{{route('barang.index')}}" class="btn btn-danger btn-large">Batal</a>
                    </form>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</body>
</html>