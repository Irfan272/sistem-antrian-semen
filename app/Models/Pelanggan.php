<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_ktp',
        'nama_pelanggan',
        'alamat',
        'no_telpon',
        'email',

    ];



    public function Delivery(){
        return $this->hasMany(DeliveryOrder::class, 'pelanggan_id');
    }
}
