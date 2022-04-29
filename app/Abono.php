<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $table = 'abonos';
    protected $fillable = ['productor_id',
    'valorAbonado', 
    'saldo'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
}
