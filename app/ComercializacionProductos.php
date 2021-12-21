<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComercializacionProductos extends Model
{
    protected $table = 'comercializacionproductos';
    protected $fillable = ['comercializacion_id','productosComers_id','cantidad','valorUnitario','otro',
                            ];

    public function comercializacion(){
        return $this->belongsTo('App\Comercializacion','comercializacion_id','id');
    }
    public function productocomer(){
        return $this->belongsTo('App\ComercializacionProductos','productosComers_id','id');
    }
}
