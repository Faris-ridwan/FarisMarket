<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pesanandetail extends Model
{
    protected $table = "pesanandetails";
    protected $fillable = ['barang_id', 'pesanan_id', 'jumlah', 'jumlah_harga'];
    protected $primarykey = 'id';

    public function barang()
    {
        return $this->belongsTo('App\barang', 'barang_id', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\pesanan', 'pesanan_id', 'id');
    }
}
