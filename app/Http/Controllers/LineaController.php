<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Linea;

class LineaController extends Controller
{
    public function selectLinea(Request $request){
        if(!$request->ajax()) return redirect('/');
        $lineas = Linea::select('id','nombre')->orderBy('id','asc')->get();
        return['lineas'=>$lineas];
    }  
}
