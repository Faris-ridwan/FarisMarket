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
                    <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="gambar_barang" class="form-label">Gamba Barang</label>
                            <input type="file" name="gambar_barang" class="form-control" id="gambar_barang">
                          </div>
                          <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama barang</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="masukan nama barang">
                          </div>
                          <div class="mb-3">
                            <label for="merk" class="form-label">Merk barang</label>
                            <input type="text" class="form-control" name="merk" id="merk" placeholder="masukan merk barang">
                          </div>
                          <div class="mb-3">
                            <label for="harga" class="form-label">harga barang</label>
                            <input type="number" class="form-control" name="harga" id="harga" placeholder="masukan harga barang">
                          </div>
                          <div class="mb-3">
                            <label for="stok" class="form-label">Stok barang</label>
                            <input type="number" class="form-control" name="stok" id="stok" placeholder="masukan stok barang">
                          </div>
                          <div class="mb-3">
                            <label for="keterangan" class="form-label">keterangan</label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="masukan keterangan">
                          </div>
                          <button class="btn btn-primary btn-large">tambah</button>
                          <a href="{{route('barang.index')}}" class="btn btn-danger btn-large">batal</a>
                    </form>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</body>
</html>


