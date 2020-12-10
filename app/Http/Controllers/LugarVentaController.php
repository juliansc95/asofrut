<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LugarVenta;

class LugarVentaController extends Controller
{
    public function selectLugarVenta(Request $request){
        if(!$request->ajax()) return redirect('/');
        $lugarVentas = LugarVenta::select('id','nombre')->orderBy('id','asc')->get();
        return['lugarVentas'=>$lugarVentas];
    }
    
    public function selectLugarVenta2(Request $request){
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $lugarVentas = LugarVenta::select('id','nombre')
        ->where('nombre', 'like', '%'. $filtro . '%')
        ->orderBy('nombre', 'asc')->get();
        return['lugarVentas'=>$lugarVentas];
    }  
}
