<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\TempImage;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    //this method return all active services
    public function index(){
        $services = DB::table('services')
        ->join('temp_images', 'services.image', '=', 'temp_images.id')
        ->select('services.*', 'temp_images.name as image_name')
        ->get();

        return $services;
    }

    public function latestServices(Request $request){
        $services = Service::where('status',1)
        ->orderBy('created_at','desc')
        ->take($request->get('limit'))
        ->get();
        return $services;
    }
}
