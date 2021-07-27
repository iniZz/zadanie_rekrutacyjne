<?php

namespace App\Service;

use App\Service\JsonService;
use Symfony\Component\HttpClient\HttpClient;

class Api
{
    

    public function GetFromAPI($url)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
    
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $content = $response->getContent();
            

            return $content;
            
        }
        
    }
}