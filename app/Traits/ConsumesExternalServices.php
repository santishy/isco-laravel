<?php
namespace App\traits;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

trait ConsumesExternalServices
{
  public function makeRequest( $method,$requestUrl,$queryParams = [],$formParams = [], $headers = [], $isJsonRequest = false)
  {
    $client = new Client([
      'base_uri' => $this->baseUri,
    ]);
    if(method_exists($this,'resolveAuthorization')){
      $this->resolveAuthorization($queryParams,$formParams,$headers);
    }

    try {
      $response = $client->request($method, $requestUrl, [
              $isJsonRequest ? 'json' : 'form_params' => $formParams,
              'headers' => $headers,
              'query' => $queryParams,
          ]);
      } catch (RequestException $e) {
         echo Psr7\str($e->getRequest());
          if ($e->hasResponse()) {
              echo Psr7\str($e->getResponse());
          }
      return (object)['status' => false];
      }
      $response = $response->getBody()->getContents();
      if(method_exists($this,'decodeResponse')){
        $response = $this->decodeResponse($response);
      }
    return $response;
  }
}

?>
