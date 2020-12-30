<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\GpxUpload;


class GpxUploadController extends Controller
{
    public function formSubmit(Request $request)
    {
        $name = $request->name;
        $fileName = time().$name.'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);
        $slash='/';
        $feed = file_get_contents('C:\xampp\htdocs\asofrut\public\upload'.$slash.$fileName);
        $gpx = simplexml_load_string($feed);
        
        foreach ($gpx->wpt as $pt) {
            $lat = (string) $pt['lat'];
            $lon = (string) $pt['lon'];
            $ele = (string) $pt->ele;
            $name = (string) $pt->name;
        }
        unset($gpx);   
        $latitud = $lat;
        $longitud=$lon;
        $gpx = new GpxUpload();
        $gpx->productor_id = $request->productor_id;
        $gpx->finca_id = $request->finca_id;
        $gpx->latitud =  $latitud;
        $gpx->longitud =  $longitud;
        $gpx->save(); 

        return response()->json(['success'=>'La carga de su archivo ha sido exitosa.']);
    }
}
