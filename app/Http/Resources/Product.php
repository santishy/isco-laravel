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
      return ['description' => $this->descripcion,
      'skuManufacturer' => $this->skuFabricante,
      'humanPrice' => number_format($this->precio,2),
      'providerPrice' => number_format($this->precio_proveedor),
      'sku' => $this->sku,
      'id' => $this->id_articulo,
      //'url_img' => 'https://www.pchmayoreo.com/media/catalog/product/cache/1/small_image/170x/9df78eab33525d08d6e5fb8d27136e95/e/q/eq-524111-56.jpg',
      'url_img' => $this->image(),
      'vinculo' => url('producto/'.$this->id_articulo),
      //'auth'=>User::isCheckAndAdmin(),
      'noimg' => asset('images/noimg.jpg'),
      'route' => route('updateProduct',$this->id_articulo),
      'imgLocal'=>$this->localFile(),
      'unloadedImage' => false,
      'brand' => $this->brand->marca,
      // 'imgExternal'=>$ele->externalFile(),
      'csrf' => csrf_token()];
        // return [
        //   'id' => $this->id_articulo,
        //   'description' => $this->descripcion,
        //   'sku' => $this->sku,
        //   'skuFabricante' => $this->skuFabricante,
        //   'price' => $this->precio,
        //   'utilidade' => $this->utilidade->ut,
        //   'existence' => $this->existence()
        // ];
    }
}
