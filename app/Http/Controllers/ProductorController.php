<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Productor;
use App\Persona;

class ProductorController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->orderBy('productors.id','desc')->paginate(3);
        }
        if($criterio == 'veredas' ||$criterio == 'resguardos'){
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        else{
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);          
        }
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->tipo_id = $request->tipo_id;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $productor = new Productor();
            $productor->fechaExpedicion = $request->fechaExpedicion;
            $productor->fechaNacimiento = $request->fechaNacimiento;
            $productor->sexo_id = $request->sexo_id;
            $productor->etnia_id = $request->etnia_id;
            $productor->escolaridad_id = $request->escolaridad_id;
            $productor->departamento_id = $request->departamento_id;
            $productor->municipio_id = $request->municipio_id;
            $productor->vereda_id = $request->vereda_id;
            $productor->resguardo_id = $request->resguardo_id;
            $productor->fechaIngreso = $request->fechaIngreso;
            $productor->fotocopiaCedula = $request->fotocopiaCedula;
            $productor->id = $persona->id;
            $productor->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $productor =Productor::findOrFail($request->id);
        $persona =Persona::findorFail($productor->id);
       
        $persona->nombre = $request->nombre;
        $persona->tipo_id = $request->tipo_id;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();    
        
        $productor->fechaExpedicion = $request->fechaExpedicion;
        $productor->fechaNacimiento = $request->fechaNacimiento;
        $productor->sexo_id = $request->sexo_id;
        $productor->etnia_id = $request->etnia_id;
        $productor->escolaridad_id = $request->escolaridad_id;
        $productor->departamento_id = $request->departamento_id;
        $productor->municipio_id = $request->municipio_id;
        $productor->vereda_id = $request->vereda_id;
        $productor->resguardo_id = $request->resguardo_id;
        $productor->fechaIngreso = $request->fechaIngreso;
        $productor->fotocopiaCedula = $request->fotocopiaCedula;
        $productor->save();      
        DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }  
    }
}
