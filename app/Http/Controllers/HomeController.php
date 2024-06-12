<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\DeliveryOrder;
use App\Models\JenisSemen;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(){
        $jenisTotal = JenisSemen::count();
        $pelangganTotal = Pelanggan::count();
        $deliveryTotal = DeliveryOrder::count();
        $antrianTotal = Antrian::count();
    
        $deliveryStatusCounts = DeliveryOrder::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();
    
        $antrianStatusCounts = Antrian::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();
    
        return view('admin.dashboard', compact(
            'jenisTotal', 'pelangganTotal', 'deliveryTotal', 'antrianTotal',
            'deliveryStatusCounts', 'antrianStatusCounts'
        ));
    }

    public function indexSecurity(){
        $jenisTotal = JenisSemen::count();
        $pelangganTotal = Pelanggan::count();
        $deliveryTotal = DeliveryOrder::count();
        $antrianTotal = Antrian::count();
    
        $deliveryStatusCounts = DeliveryOrder::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();
    
        $antrianStatusCounts = Antrian::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();
    
        return view('security.dashboard', compact(
            'jenisTotal', 'pelangganTotal', 'deliveryTotal', 'antrianTotal',
            'deliveryStatusCounts', 'antrianStatusCounts'
        ));
    }
    
}
