<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Comercializacion;
use App\Abono;
use App\ComercializacionProductos;
class ComercializacionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
            ->join('productors','comercializacions.productor_id','=','productors.id')
            ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
            'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta','personas.nombre as nombre_persona')
             ->orderBy('comercializacions.id', 'desc')->paginate(10);
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
            $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
            ->join('productors','comercializacions.productor_id','=','productors.id')
            ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
            'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta','personas.nombre as nombre_persona')
            ->where('comercializacions.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('comercializacions.id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $comercializacion->total(),
                'current_page' => $comercializacion->currentPage(),
                'per_page'     => $comercializacion->perPage(),
                'last_page'    => $comercializacion->lastPage(),
                'from'         => $comercializacion->firstItem(),
                'to'           => $comercializacion->lastItem(),
            ],
            'comercializacion' => $comercializacion
        ];
    }

    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;
        $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
        ->join('productors','comercializacions.productor_id','=','productors.id')
        ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
        'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta','personas.nombre as nombre_persona')
        ->where('comercializacions.id','=',$id)
        ->orderBy('comercializacions.id', 'desc')->take(1)->get();
        
        return ['comercializacion' => $comercializacion];
    }
    public function obtenerProductoComercializacion(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $productoComercializacion = ComercializacionProductos::join('productoscomers','comercializacionproductos.productosComers_id','=','productoscomers.id')
        ->select('comercializacionproductos.cantidad','comercializacionproductos.valorUnitario','comercializacionproductos.otro',
        'productoscomers.nombre as nombre_producto')
        ->where('comercializacionproductos.comercializacion_id','=',$id)
        ->orderBy('comercializacionproductos.id', 'desc')->get();
        
        return ['productoComercializacion' => $productoComercializacion];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $comercializacion = new Comercializacion();
            $comercializacion->productor_id = $request->productor_id;
            $comercializacion->otro = $request->otro;
            $comercializacion->fechaVenta = $mytime->toDateTimeString();
            $comercializacion->totalVenta = $request->totalVenta;
            $comercializacion->totalUnidades = $request->totalUnidades;
            $comercializacion->save();

            $comercializacionproductos = $request->data;//Array de detalles
            //Recorro todos los elementos

            $abono = new Abono();
            $abono->productor_id = $request->productor_id;
            $abono->valorAbonado = $request->valorAbonado;
            $abono->saldo = $request->saldo;
            $abono->save();


            foreach($comercializacionproductos as $ep=>$comerPro)
            {
                $comercializacionproducto = new ComercializacionProductos();
                $comercializacionproducto->comercializacion_id = $comercializacion->id;
                $comercializacionproducto->productosComers_id = $comerPro['productosComers_id'];
                $comercializacionproducto->cantidad = $comerPro['cantidad'];
                $comercializacionproducto->valorUnitario = $comerPro['valorUnitario'];
                $comercializacionproducto->otro = '';    
                $comercializacionproducto->save();
            }          

            DB::commit();
            return[
                'id'=>$comercializacion->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function excel(){
        $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
            ->join('productors','comercializacions.productor_id','=','productors.id')
            ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
            'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta','personas.nombre as nombre_persona')
             ->orderBy('comercializacions.id', 'desc')->get();
        return [
            'comercializacion' => $comercializacion
        ];
        
    }

    public function pdf(Request $request,$id){

        $id = $request->id;
        $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
        ->join('productors','comercializacions.productor_id','=','productors.id')
        ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
        'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'personas.direccion as direccion','personas.telefono as telefono',
        'personas.telefono as telefono','personas.email as email')
        ->where('comercializacions.id','=',$id)
        ->orderBy('comercializacions.id', 'desc')->take(1)->get();
 
        $productoComercializacion = ComercializacionProductos::join('productoscomers','comercializacionproductos.productosComers_id','=','productoscomers.id')
        ->select('comercializacionproductos.cantidad','comercializacionproductos.valorUnitario','comercializacionproductos.otro',
        'productoscomers.nombre as nombre_producto')
        ->where('comercializacionproductos.comercializacion_id','=',$id)
        ->orderBy('comercializacionproductos.id', 'desc')->get();


       
        $nombrePdf=Comercializacion::select('comercializacions.fechaVenta')
        ->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.comercializacion',['comercializacion'=>$comercializacion,'productoComercializacion' => $productoComercializacion]);
        return $pdf->download('comercializacion-'.$nombrePdf[0]->fechaVenta.'.pdf');
    }

    public function listarPdf(){
        $ahora= Carbon::now('America/Bogota');

        $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
        ->join('productors','comercializacions.productor_id','=','productors.id')
        ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
        'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'personas.direccion as direccion','personas.telefono as telefono',
        'personas.telefono as telefono','personas.email as email')
        ->orderBy('comercializacions.id', 'desc')->get();
        $cont=Comercializacion::count();

        $pdf = \PDF::loadView('pdf.comercializacions',['comercializacion'=>$comercializacion,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('comercializacions.pdf');
    }

    public function listarPdfDiario(){
        
        $ahora= Carbon::now('America/Bogota');
        $today= Carbon::now('America/Bogota')->toDateString();

        $tomorrow= new Carbon('tomorrow');

        $comercializacion = Comercializacion::join('personas','comercializacions.productor_id','=','personas.id')
        ->join('productors','comercializacions.productor_id','=','productors.id')
        ->select('comercializacions.id','comercializacions.productor_id','comercializacions.otro',
        'comercializacions.fechaVenta','comercializacions.totalUnidades','comercializacions.totalVenta',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'personas.direccion as direccion','personas.telefono as telefono',
        'personas.telefono as telefono','personas.email as email')
        ->whereBetween('fechaVenta',[$today,$tomorrow])
        ->orderBy('comercializacions.id', 'desc')->get();
        $cont=count($comercializacion);

        $pdf = \PDF::loadView('pdf.comercializacions',['comercializacion'=>$comercializacion,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('ventas'.$today.'.pdf');
    }


}
