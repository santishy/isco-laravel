<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $sql=array();
    protected $table='secciones';
    protected $primaryKey='id_seccion';
    protected $fillable=['seccion'];
    public $timestamps=false;

    // public static  function articles()
    // {
    //     $query = DB::table('secciones')    
    //             ->join('articulos','articulos.id_seccion','=','secciones.id_seccion')
    //             ->join('detinvart','detinvart.id_articulo','=','articulos.id_articulo')
    //             ->where('id_utilidad','!=',0)
    //             ->where('existencia','>',0)
    //             ->where('secciones.id_seccion','=',\Session::get('id_seccion'));
    //     return $query;
    //      // return $this->hasMany('App\Articulo','id_seccion','id_seccion')->orderBy('precio','asc')
    //      //        ->where('id_utilidad','!=',0)->orderby('precio','asc');
    // }
    public  function articles()
    {
         return $this->hasMany('App\Articulo','id_seccion','id_seccion')->where('id_utilidad','!=',0)->where('activo','=',1);
    }
    public function series()
    {
           
        return $this->belongsToMany('App\Serie','articulos','id_seccion','id_serie')
            ->distinct()->where('articulos.activo','=',1);
    }
    public function lines()
    {
        return $this->belongsToMany('App\Line','articulos','id_seccion','id_linea')
            ->distinct()->where('articulos.activo','=',1)->orderby('precio','asc');;
    }

    public function scopeSerie($query,$id)
    {
        return $query->where('id_serie','=',$id);
    }
    public function seriesProducts($data){
        $array=$data->except('_token');
        $sql=array();
        foreach($array as $value)
        {
            array_push($this->sql,['id_serie','=',$value]);
        }
        //dd($this->sql);
        return $this->hasMany('App\Articulo','id_seccion','id_seccion')->where('activo',1)->where(function($query){
            $query->orWhere($this->sql);
        });
        // if(count($sql)==1)
        //     return $this->hasMany('App\Articulo','id_seccion','id_seccion')->where($sql)->orderby('precio','asc');
        // else
        // {
        //     // $ini=$sql[0];
        //     // unset($sql[0]);
        //     return $this->hasMany('App\Articulo','id_seccion','id_seccion')->orWhere($sql)->orderby('precio','asc');

        // }
    }
}
