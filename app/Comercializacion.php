<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comercializacion extends Model
{
    protected $table = 'comercializacions';
    protected $fillable = ['productor_id',
    'otro','fechaVenta','totalVenta','totalUnidades'];

    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }
}
