<?php

namespace App\Service;


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
            print_r($content);
            die();
            
        }
        
    }
}