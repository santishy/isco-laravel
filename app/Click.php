<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Click extends Model
{
  	protected $guarded=['id'];

  public function articulo()
  {
    return $this->belongsTo(Articulo::class,'id_articulo','id_articulo');
  }
}
