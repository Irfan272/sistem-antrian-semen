<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSemen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jenis',
    ];

    public function Delivery(){
        return $this->hasMany(DeliveryOrder::class, 'jenis_id');
    }
}
