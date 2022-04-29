<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Abono;


class AbonoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $abono = Abono::join('personas','abonos.productor_id','=','personas.id')
            ->join('productors','abonos.productor_id','=','productors.id')
            ->select('abonos.id','abonos.productor_id','abonos.valorAbonado',
            'abonos.saldo','abonos.created_at','personas.nombre as nombre_persona')
            ->where('abonos.saldo','>',0,'and','abonos.valorAbonado','>',0)
             ->orderBy('abonos.id', 'desc')->paginate(10);
        }
        if($criterio == 'personas'){
            $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
            ->join('productors','comercializacions.productor_id','=','productors.id')
            ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
            'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta','personas.nombre as nombre_persona')
        ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
        ->orderBy('comercializacions.id', 'desc')->paginate(10);
        }
        else{
            $id = $request->id;
            $abono = Abono::join('personas','abonos.productor_id','=','personas.id')
            ->join('productors','abonos.productor_id','=','productors.id')
            ->select('abonos.id','abonos.productor_id','abonos.valorAbonado',
            'abonos.saldo','abonos.created_at','personas.nombre as nombre_persona')
            ->where('abonos.saldo','>',0,'and','abonos.valorAbonado','>',0)
             ->orderBy('abonos.id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $abono->total(),
                'current_page' => $abono->currentPage(),
                'per_page'     => $abono->perPage(),
                'last_page'    => $abono->lastPage(),
                'from'         => $abono->firstItem(),
                'to'           => $abono->lastItem(),
            ],
            'abono' => $abono
        ];
    }
}
