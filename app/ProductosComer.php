<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductosComer extends Model
{
    protected $table = 'productoscomers';
    protected $fillable = ['id','nombre','valorUnitario']; 
}
