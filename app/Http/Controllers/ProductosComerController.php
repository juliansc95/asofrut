<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProductosComer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductosComerController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $productos= ProductosComer::select('id','nombre','ICA','valorUnitario')
            ->orderBy('id','desc')->paginate(10);
        }
        else{
            $productos= ProductosComer::select('id','nombre','ICA','valorUnitario')
            ->where('productoscomers.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productoscomers.id', 'desc')->paginate(3);          
        }
        return [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    public function buscarCategoria(Request $request){ 
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $productos= ProductosComer::where('id','=',$filtro)
        ->select('id','nombre','ICA','valorUnitario')
        ->orderBy('nombre','asc')
        ->take(1)->get();
        return[ 'productos' => $productos];
    }

    public function listarCategoria(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos= ProductosComer::select('id','nombre','ICA','valorUnitario')
            ->orderBy('id','desc')->paginate(10);
        }
        else{
            $productos= ProductosComer::select('id','nombre','ICA','valorUnitario') 
            ->where('productoscomers.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('id','desc')->paginate(10);        }
        

        return ['productos' => $productos];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        try{
        DB::beginTransaction();    
        $producto = new ProductosComer();
        $producto->nombre = $request->nombre;
        $producto->ICA = $request->ICA;
        $producto->valorUnitario = $request->valorUnitario;
        $producto->save();

        DB::commit();    
        } catch(Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {      
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();

        $producto= ProductosComer::findOrFail($request->id);    
        $producto->nombre = $request->nombre;
        $producto->ICA = $request->ICA;
        $producto->valorUnitario = $request->valorUnitario;
        $producto->save();
        DB::commit();    
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $productos= ProductosComer::select('id','nombre','ICA','valorUnitario')
        ->orderBy('id','desc')->get();
        $cont=ProductosComer::count();

        $pdf = \PDF::loadView('pdf.productos',['productos'=>$productos,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('productos.pdf');
    }

    public function excel(Request $request)
    {
        $productos= ProductosComer::select('id','nombre','ICA','valorUnitario')
        ->orderBy('id','asc')->get();
        return [
            'productos' => $productos
        ];        
    }
}
