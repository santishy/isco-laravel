<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
class Click extends Model
{
  	protected $guarded=['id'];

  public function articulo()
  {
    return $this->belongsTo(Articulo::class,'id_articulo','id_articulo');
  }
  public static function mostVisited(){
    return Click::with(['articulo' => function($query){
      $query->where('id_utilidad','>',0);
    }])->where('qty','>',0)->orderBy('qty','desc')->limit(10)->get();
  }
}
