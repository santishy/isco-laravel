<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table='inventario';
    protected $fillable=['almacen'];
    protected $primaryKey="id_inventario";
    public $timestamps=false;
}
