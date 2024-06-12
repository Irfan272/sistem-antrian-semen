<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'nomor_kendaraan',
        'nama_pengemudi',
        'waktu_kedatangan',
        'status',

    ];

    public function DeliveryOrder(){
        return $this->belongsTo(DeliveryOrder::class, 'delivery_id');
    }

}
