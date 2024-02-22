<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    protected $table = "pesanans";
    protected $fillable = ['user_id', 'tanggal', 'status', 'jumlah'];
    protected $primarykey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function pesanan_detail()
    {
        return $this->hasMany('App\pesanandetail', 'pesanan_id', 'id');
    }
}
