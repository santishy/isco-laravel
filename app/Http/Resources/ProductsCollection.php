<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProductsCollection extends ResourceCollection
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
                    'description' => $ele->descripcion,
                    'skuManufacturer' => $ele->skuFabricante,
                    'humanPrice' => number_format($ele->price,2),
                    'providerPrice' => number_format($ele->precio_proveedor),
                    'sku' => $ele->sku,
                    'id' => $ele->id_articulo,
                    'url_img' => $ele->image(),
                    'vinculo' => url('producto/'.$ele->id_articulo),
                    'auth'=>User::isCheckAndAdmin(),
                    'noimg' => asset('images/noimg.jpg'),
                    'route' => route('updateProduct',$ele->id_articulo),
                    'imgLocal'=>$ele->localFile(),
                    // 'imgExternal'=>$ele->externalFile(),
                    'csrf' => csrf_token()
                ];
            })
        ];
    }
}
