<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static $COMPUTADORA = 1;
    public static $IMPRESORA = 2;

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
