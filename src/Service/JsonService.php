<?php

namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;

class JsonService
{
    public function ConvertToArray($json){
        $objJson = json_decode($json);
        $array = array();
        foreach($objJson as $mydata)
        {
            foreach($mydata->rates as $values)
            {
                array_push($array, array("currency" => $values->currency, "code" => $values->code,"mid" => number_format($values->mid , 3)));
            }
        }
    
        return $array;
    }

    public function getRepeat($content , $content2){
    
        $array = array();
        foreach($content as $mydata)
        {
            foreach ($content2 as $key => $value) {
                // print_r($value);
                if ($mydata->getCurrencyCode() == $value['code'] ) {
                    // echo $value['code'];
                    array_push($array, array("currency" => $value['currency'], "code" => $value['code'],"mid" => $value['mid']));
                }
            }
                
           
        }
        return $array;
     }
    
}