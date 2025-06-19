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
        ->orderBy('services.id', 'desc')
        ->get();

        return $services;
    }

    public function latestServices(Request $request){
        $services = DB::table('services')
        ->join('temp_images', 'services.image', '=', 'temp_images.id')
        ->select('services.*', 'temp_images.name as image_name')
        ->orderBy('services.id', 'desc')
        ->take($request->get('limit'))
        ->get();

        return $services;
    }
}
