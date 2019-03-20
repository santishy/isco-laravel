<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    protected $table="lineas";
    protected $primaryKey='id_linea';
    protected $fillable=['linea'];

    public function products(){
    	return $this->hasMany('App\Articulo','id_linea','id_linea');
    }

}
