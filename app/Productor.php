<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    protected $table = 'productors';
    protected $fillable = ['nombre','tipo_id','numeroid','fechaExpedicion',
    'fechaNacimiento','sexo_id','etnia_id','escolaridad_id','telefono','correo','departamento_id',
    'municipio_id','vereda_id','resguardo_id','fechaIngreso','fotocopiaCedula','condicion']; 

    public function tipoid(){
        return $this->belongsTo('App\TipoId', 'tipo_id', 'id');
    }
    public function sexo(){
        return $this->belongsTo('App\Sexo', 'sexo_id', 'id');
    }
    public function etnia(){
        return $this->belongsTo('App\Etnia', 'etnia_id', 'id');
    }
    public function gradoescolaridad(){
        return $this->belongsTo('App\GradoEscolaridad', 'escolaridad_id', 'id');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id', 'id');
    }
    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id', 'id');
    }
    public function vereda(){
        return $this->belongsTo('App\Vereda', 'vereda_id', 'id');
    }
    public function resguardo(){
        return $this->belongsTo('App\Resguardo', 'resguardo_id', 'id');
    }
 
}
