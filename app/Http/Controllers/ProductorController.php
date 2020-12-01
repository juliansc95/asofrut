<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productor;

class ProductorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $productors= Productor::join('tipoIds','productors.tipo_id','=','tipoIds.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('productors.id','productors.nombre','tipoIds.nombre as nombre_tipo','productors.numeroid',
            'productors.fechaExpedicion','productors.fechaNacimiento','sexos.nombre as nombre_sexo',
            'etnias.nombre as nombre_etnia','gradoEscolaridads.nombre as nombre_escolaridad','productors.telefono',
            'productors.correo','departamentos.nombre as nombre_departamento','municipios.nombre as nombre_municipio',
            'veredas.nombre as nombre_vereda','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula','productors.condicion')
            ->orderBy('productors.id','desc')->paginate(3);
        }
        else{
            $productors = Productor::join('tipoIds','productors.tipo_id','=','tipoIds.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('productors.id','productors.nombre','tipoIds.nombre as nombre_tipo','productors.numeroid',
            'productors.fechaExpedicion','productors.fechaNacimiento','sexos.nombre as nombre_sexo',
            'etnias.nombre as nombre_etnia','gradoEscolaridads.nombre as nombre_escolaridad','productors.telefono',
            'productors.correo','departamentos.nombre as nombre_departamento','municipios.nombre as nombre_municipio',
            'veredas.nombre as nombre_vereda','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula','productors.condicion')
            ->where('productors.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productors.id', 'desc')->paginate(3);          
        }
        return [
            'pagination' => [
                'total'        => $productors->total(),
                'current_page' => $productors->currentPage(),
                'per_page'     => $productors->perPage(),
                'last_page'    => $productors->lastPage(),
                'from'         => $productors->firstItem(),
                'to'           => $productors->lastItem(),
            ],
            'productors' => $productors
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productor = new Productor();
        $productor->nombre = $request->nombre;
        $productor->tipo_id = $request->tipo_id;
        $productor->numeroid = $request->numeroid;
        $productor->fechaExpedicion = $request->fechaExpedicion;
        $productor->fechaNacimiento = $request->fechaNacimiento;
        $productor->sexo_id = $request->sexo_id;
        $productor->etnia_id = $request->etnia_id;
        $productor->escolaridad_id = $request->escolaridad_id;
        $productor->telefono = $request->telefono;
        $productor->correo = $request->correo;
        $productor->departamento_id = $request->departamento_id;
        $productor->municipio_id = $request->municipio_id;
        $productor->vereda_id = $request->vereda_id;
        $productor->resguardo_id = $request->resguardo_id;
        $productor->fechaIngreso = $request->fechaIngreso;
        $productor->fotocopiaCedula = $request->fotocopiaCedula;
        $productor->condicion = '1';
        $productor->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productor = Productor::findOrFail($request->id);
        $productor->nombre = $request->nombre;
        $productor->tipo_id = $request->tipo_id;
        $productor->numeroid = $request->numeroid;
        $productor->fechaExpedicion = $request->fechaExpedicion;
        $productor->fechaNacimiento = $request->fechaNacimiento;
        $productor->sexo_id = $request->sexo_id;
        $productor->etnia_id = $request->etnia_id;
        $productor->escolaridad_id = $request->escolaridad_id;
        $productor->telefono = $request->telefono;
        $productor->correo = $request->correo;
        $productor->departamento_id = $request->departamento_id;
        $productor->municipio_id = $request->municipio_id;
        $productor->vereda_id = $request->vereda_id;
        $productor->resguardo_id = $request->resguardo_id;
        $productor->fechaIngreso = $request->fechaIngreso;
        $productor->fotocopiaCedula = $request->fotocopiaCedula;
        $productor->condicion = '1';
        $articulo->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productor = Productor::findOrFail($request->id);
        $productor->condicion = '0';
        $productor->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $productor = Productor::findOrFail($request->id);
        $productor->condicion = '1';
        $productor->save();
    }

}
