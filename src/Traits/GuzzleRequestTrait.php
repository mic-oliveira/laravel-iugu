<?php


namespace Iugu\Traits;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\VarDumper\Cloner\Data;

trait GuzzleRequestTrait
{

    private $guzzleClient;

    protected $basePath;

    public function createRequest()
    {
        if($this->guzzleClient === null){
            $this->guzzleClient = new Client(
                array_merge([
                    'base_uri' => config('iugu.url'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-type' => 'application/json',
                        'Authorization' => 'Basic '.base64_encode(config('iugu.token'))
                    ]
                ]),
            );
        }
        return $this->guzzleClient;
    }

    public function getClient()
    {
        return $this->guzzleClient;
    }

    public function setClient(Client $client)
    {
        $this->guzzleClient = $client;
        return $this;
    }

    private function setBasePath($basePath='')
    {
        $this->basePath=$basePath;
    }

    public function getBasePath()
    {
        if (empty($basePath))
        {
            $this->basePath = "/".config('iugu.api_version')."/$this->table/$this->iugu_id";
        }
        return $this->basePath;
    }

    private function decodeResponse(ResponseInterface $response)
    {
        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }
}
