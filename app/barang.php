<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = "barangs";
    protected $fillable = ['nama_barang', 'gambar_barang','merk', 'harga', 'stok', 'keterangan'];
    protected $primarykey = "id";

    public function pesanan_detail()
    {
        return $this->hasMany('App\pesanandetail', 'barang_id', 'id');
    }
}
