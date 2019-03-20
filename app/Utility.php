<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    //
    protected $table='utilidades';
    protected $primaryKey='id_utilidad';
    protected $fillable=['ut','desde','hasta','categoria'];
    public static function addUtilidad($data)
    {
        $utilidad=Utility::where('hasta','>=',$data['precio'])
                            ->where('desde','<=',$data['precio'])
                            ->where('categoria','=',$data['categoria'])
                            ->first();
        if($utilidad != null)//if(count($utilidad)>0)
        {
            $data['article']->id_utilidad=$utilidad->id_utilidad;
            $data['article']->save();
        }
        return $utilidad;
    }
}
