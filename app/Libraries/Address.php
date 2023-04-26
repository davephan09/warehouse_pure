<?php 
namespace App\Libraries;
use GuzzleHttp\Client;

class Address 
{
    const API_TIMEOUT = 8;
    private $client;
    
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://provinces.open-api.vn/api/',
            'timeout' => self::API_TIMEOUT,
            'verify' => false
        ]);
    }

    public function getAddress()
    {
        $data = array();
        try {
            $response = $this->client->request('GET', '', [
                'query' => [
                    'depth' => 3
                ]
            ]);
            $response = json_decode($response->getBody());
            return $response;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
        }
    }
}