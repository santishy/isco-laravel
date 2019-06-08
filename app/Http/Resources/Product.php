<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id_articulo,
          'description' => $this->descripcion,
          'sku' => $this->sku,
          'skuFabricante' => $this->skuFabricante,
          'price' => $this->precio,
          'utilidade' => $this->utilidade->ut,
          'existence' => $this->existence()
        ];
    }
}
