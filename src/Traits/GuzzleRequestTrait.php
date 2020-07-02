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

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->guzzleClient;
    }

    public function setClient(Client $client)
    {
        $this->guzzleClient = $client;
        return $this;
    }

    public function setBasePath($basePath='')
    {
        $this->basePath=$basePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        if (empty($this->basePath))
        {
            $this->basePath = "/".config('iugu.api_version')."/$this->table/$this->iugu_id";
        }
        return $this->basePath;
    }

    /**
     * @param ResponseInterface $response
     * @param bool $assoc
     * @return mixed
     */
    private function decodeResponse(ResponseInterface $response,$assoc=false)
    {
        return \GuzzleHttp\json_decode($response->getBody()->getContents(),$assoc);
    }
}
