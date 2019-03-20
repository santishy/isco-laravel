<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remision extends Model
{
    protected $table="remisiones";
    protected $primaryKey="id";
    protected $fillable=['moneda','remision','mensaje','almacen','payment_id','status'];
}
