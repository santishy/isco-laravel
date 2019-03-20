<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    //
    protected $table='series';
    protected $fillable=['name'];
    protected $pk='id_serie';
    public function articles()
    {
        return $this->hasMany('App\Articulo','id_serie');
    }
    // public function lines(){
    // 	return 
    // }
}
