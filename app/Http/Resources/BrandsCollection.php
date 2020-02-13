<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'data' => $this->collection->transform(function($ele){
              return [
                'name' => $ele->marca,
                'id' => $ele->id_marca
              ];
          }),
          'url' => '/brand-products/'
        ];
    }
}
