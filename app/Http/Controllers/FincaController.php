<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Finca;

class FincaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $fincas= Finca::join('productors','fincas.productor_id','=','productors.id')
            ->join('personas','fincas.productor_id','=','personas.id')
            ->join('lineas','fincas.linea_id','=','lineas.id')
            ->join('departamentos','fincas.departamento_id','=','departamentos.id')
            ->join('municipios','fincas.municipio_id','=','municipios.id')
            ->join('veredas','fincas.vereda_id','=','veredas.id')
            ->join('resguardos','fincas.resguardo_id','=','resguardos.id')
            ->join('posesions','fincas.posesion_id','=','posesions.id')
            ->select('fincas.id','fincas.nombre','fincas.productor_id','fincas.linea_id','fincas.areaPredio',
            'fincas.longitudPredio','fincas.latitudPredio','fincas.altitudPredio','fincas.departamento_id',
            'fincas.municipio_id','fincas.vereda_id','fincas.resguardo_id','fincas.posesion_id',
            'fincas.distanciaAlLote','personas.nombre as nombre_persona','fincas.distanciaLoteVia','coordenadasFinca','lineas.nombre as nombre_linea',
            'posesions.nombre as nombre_posesion','departamentos.nombre as nombre_departamento',
            'municipios.nombre as nombre_municipio','veredas.nombre as nombre_vereda','resguardos.nombre as nombre_resguardo')
            ->orderBy('fincas.id','desc')->paginate(3);
        }
        else{
            $fincas= Finca::join('productors','fincas.productor_id','=','productors.id')
            ->join('personas','fincas.productor_id','=','personas.id')
            ->join('lineas','fincas.linea_id','=','lineas.id')
            ->join('departamentos','fincas.departamento_id','=','departamentos.id')
            ->join('municipios','fincas.municipio_id','=','municipios.id')
            ->join('veredas','fincas.vereda_id','=','veredas.id')
            ->join('resguardos','fincas.resguardo_id','=','resguardos.id')
            ->join('posesions','fincas.posesion_id','=','posesions.id')
            ->select('fincas.id','fincas.nombre','fincas.productor_id','fincas.linea_id','fincas.areaPredio',
            'fincas.longitudPredio','fincas.latitudPredio','fincas.altitudPredio','fincas.departamento_id',
            'fincas.municipio_id','fincas.vereda_id','fincas.resguardo_id','fincas.posesion_id',
            'fincas.distanciaAlLote','personas.nombre as nombre_persona','fincas.distanciaLoteVia','coordenadasFinca','lineas.nombre as nombre_linea',
            'posesions.nombre as nombre_posesion','departamentos.nombre as nombre_departamento',
            'municipios.nombre as nombre_municipio','veredas.nombre as nombre_vereda','resguardos.nombre as nombre_resguardo')
            ->where('fincas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('fincas.id', 'desc')->paginate(3);          
        }
        return [
            'pagination' => [
                'total'        => $fincas->total(),
                'current_page' => $fincas->currentPage(),
                'per_page'     => $fincas->perPage(),
                'last_page'    => $fincas->lastPage(),
                'from'         => $fincas->firstItem(),
                'to'           => $fincas->lastItem(),
            ],
            'fincas' => $fincas
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $finca = new Finca();
        $finca->nombre = $request->nombre;
        $finca->productor_id = $request->productor_id;
        $finca->linea_id = $request->linea_id;
        $finca->areaPredio = $request->areaPredio;
        $finca->longitudPredio = $request->longitudPredio;
        $finca->latitudPredio = $request->latitudPredio;
        $finca->altitudPredio = $request->altitudPredio;
        $finca->departamento_id = $request->departamento_id;
        $finca->municipio_id = $request->municipio_id;
        $finca->vereda_id = $request->vereda_id;
        $finca->resguardo_id = $request->resguardo_id;
        $finca->posesion_id = $request->posesion_id;
        $finca->distanciaAlLote = $request->distanciaAlLote;
        $finca->distanciaLoteVia = $request->distanciaLoteVia;
        $finca->coordenadasFinca = $request->coordenadasFinca;
        $finca->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function update(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $finca =Finca::findOrFail($request->id);
        $finca->nombre = $request->nombre;
        $finca->productor_id = $request->productor_id;
        $finca->linea_id = $request->linea_id;
        $finca->areaPredio = $request->areaPredio;
        $finca->longitudPredio = $request->longitudPredio;
        $finca->latitudPredio = $request->latitudPredio;
        $finca->altitudPredio = $request->altitudPredio;
        $finca->departamento_id = $request->departamento_id;
        $finca->municipio_id = $request->municipio_id;
        $finca->vereda_id = $request->vereda_id;
        $finca->resguardo_id = $request->resguardo_id;
        $finca->posesion_id = $request->posesion_id;
        $finca->distanciaAlLote = $request->distanciaAlLote;
        $finca->distanciaLoteVia = $request->distanciaLoteVia;
        $finca->coordenadasFinca = $request->coordenadasFinca;
        $finca->save();
    }
}
