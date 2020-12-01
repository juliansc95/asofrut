<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    public function posesion(){
        return $this->belongsTo('App\Posesion', 'posesion_id', 'id');
    }
    public function linea(){
        return $this->belongsTo('App\Linea', 'linea_id', 'id');
    }
} 
