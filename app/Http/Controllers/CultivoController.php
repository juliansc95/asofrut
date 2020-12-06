<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cultivo;

class CultivoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $cultivos= Cultivo::join('productors','cultivos.productor_id','=','productors.id')
            ->join('personas','cultivos.productor_id','=','personas.id')
            ->join('fincas','cultivos.finca_id','=','fincas.id')
            ->join('cadenas','cultivos.cadena_id','=','cadenas.id')
            ->join('lugarVentas','cultivos.lugarVenta_id','=','lugarVentas.id')
            ->select('cultivos.id','cultivos.productor_id','cultivos.cadena_id','cultivos.areaSembrada',
            'cultivos.fechaSiembra','cultivos.numeroPlantulasArboles','cultivos.totalVentasKgAnioAnterior',
            'cultivos.precioPromedio','cultivos.TotalVentasAnioAnterior','cultivos.lugarVenta_id',
            'personas.nombre as nombre_persona','fincas.nombre as nombre_finca','cadenas.nombre as nombre_cadena',
            'lugarVentas.nombre as nombre_lugarVenta')
            ->orderBy('cultivos.id','desc')->paginate(3);
        }
        else{
            $cultivos= Cultivo::join('productors','cultivos.productor_id','=','productors.id')
            ->join('personas','cultivos.productor_id','=','personas.id')
            ->join('fincas','cultivos.finca_id','=','fincas.id')
            ->join('cadenas','cultivos.cadena_id','=','cadenas.id')
            ->join('lugarVentas','cultivos.lugarVenta_id','=','lugarVentas.id')
            ->select('cultivos.id','cultivos.productor_id','cultivos.cadena_id','cultivos.areaSembrada',
            'cultivos.fechaSiembra','cultivos.numeroPlantulasArboles','cultivos.totalVentasKgAnioAnterior',
            'cultivos.precioPromedio','cultivos.TotalVentasAnioAnterior','cultivos.lugarVenta_id',
            'personas.nombre as nombre_persona','fincas.nombre as nombre_finca','cadenas.nombre as nombre_cadena',
            'lugarVentas.nombre as nombre_lugarVenta')
            ->where('cultivos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cultivos.id', 'desc')->paginate(3);          
        }
        return [
            'pagination' => [
                'total'        => $cultivos->total(),
                'current_page' => $cultivos->currentPage(),
                'per_page'     => $cultivos->perPage(),
                'last_page'    => $cultivos->lastPage(),
                'from'         => $cultivos->firstItem(),
                'to'           => $cultivos->lastItem(),
            ],
            'cultivos' => $cultivos
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $cultivo = new Cultivo();
        $cultivo->productor_id = $request->productor_id;
        $cultivo->finca_id = $request->finca_id;
        $cultivo->cadena_id = $request->cadena_id;
        $cultivo->areaSembrada = $request->areaSembrada;
        $cultivo->fechaSiembra = $request->fechaSiembra;
        $cultivo->numeroPlantulasArboles = $request->numeroPlantulasArboles;
        $cultivo->totalVentasKgAnioAnterior = $request->totalVentasKgAnioAnterior;
        $cultivo->precioPromedio = $request->precioPromedio;
        $cultivo->TotalVentasAnioAnterior = $request->TotalVentasAnioAnterior;
        $cultivo->lugarVenta_id = $request->lugarVenta_id;
        $cultivo->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $cultivo =Cultivo::findOrFail($request->id);
        $cultivo->productor_id = $request->productor_id;
        $cultivo->finca_id = $request->finca_id;
        $cultivo->cadena_id = $request->cadena_id;
        $cultivo->areaSembrada = $request->areaSembrada;
        $cultivo->fechaSiembra = $request->fechaSiembra;
        $cultivo->numeroPlantulasArboles = $request->numeroPlantulasArboles;
        $cultivo->totalVentasKgAnioAnterior = $request->totalVentasKgAnioAnterior;
        $cultivo->precioPromedio = $request->precioPromedio;
        $cultivo->TotalVentasAnioAnterior = $request->TotalVentasAnioAnterior;
        $cultivo->lugarVenta_id = $request->lugarVenta_id;
        $cultivo->save();
    }
}
