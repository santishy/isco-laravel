<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detinvart extends Model
{
    protected $fillable=['existencia','id_inventario','id_articulo'];
    public $table='detinvart';
    protected $primaryKey='id';
    public static function emptyStock(){
      return Detinvart::where('id','>',0)->delete();
    	//return Detinvart::where('id','>', 0)->update(['existencia' => 0]);
    }

}
