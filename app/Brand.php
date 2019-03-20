<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="marcas";
    protected $primaryKey="id_marca";
    protected $fillable=['marca'];
    public $timestamps=false;
    public function articles(){
    	return $this->hasMany('App\Articulo','id_marca','id_marca')
                ->where('id_utilidad','!=',0)->where('activo','=',1)->orderby('precio','asc');;
    }
     public function series()
    {
        return $this->belongsToMany('App\Serie','articulos','id_marca','id_serie')
            ->distinct();
    }
    public function lines()
    {
        return $this->belongsToMany('App\Line','articulos','id_marca','id_linea')
            ->distinct()->orderby('precio','asc');
    }
    public function seriesProducts($data){
        $array=$data->except('_token');
        $sql=array();
        foreach($array as $value)
        {
            array_push($sql,['id_serie','=',$value]);
        }
        if(count($sql)==1)
            return $this->hasMany('App\Articulo','id_marca','id_marca')->where($sql)->where('activo','=',1)->orderby('precio','asc');
        else
        {
            return $this->hasMany('App\Articulo','id_marca','id_marca')->orWhere($sql)->where('activo','=',1)->orderby('precio','asc');
        }
    }
}
