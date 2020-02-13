<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SectionCollection extends ResourceCollection
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
              'name' => $ele->seccion,
              'id' => $ele->id_seccion
            ];
        }),
        'url' => '/section-products/'
      ];
    }
}