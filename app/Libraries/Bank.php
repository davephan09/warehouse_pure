<?php 
namespace App\Libraries;
use GuzzleHttp\Client;

class Bank 
{
    const API_TIMEOUT = 8;
    private $client;
    
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.vietqr.io/v2/banks',
            'timeout' => self::API_TIMEOUT,
            'verify' => false
        ]);
    }

    public function getBanks()
    {
        $data = array();
        try {
            $response = $this->client->request('GET', '', []);
            $response = json_decode($response->getBody());
            if(is_object($response) && json_last_error() === JSON_ERROR_NONE) {
                return (empty($response->data)) ? $data : $response->data;
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
        }
    }
}