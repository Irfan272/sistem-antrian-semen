<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_do',
        'pelanggan_id',
        'jenis_id',
        'jumlah_semen',
        'waktu_pemesanan',
        'status',

    ];

    public function JenisSemen(){
        return $this->belongsTo(JenisSemen::class, 'jenis_id');
    }

    public function Pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function Antrian(){
        return $this->hasMany(Antrian::class, 'delivery_id');
    }
}
