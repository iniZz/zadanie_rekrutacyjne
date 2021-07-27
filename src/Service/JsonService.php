<?php

namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;

class JsonService
{
    public function ConvertToArray($json){

        if ($json != null) {
            $objJson = json_decode($json);
            $array = array();
            foreach($objJson as $mydata)
            {
                foreach($mydata->rates as $values)
                {
                    array_push($array, array("currency" => $values->currency, "code" => $values->code,"mid" => number_format($values->mid , 2)));
                }
            }
            return $array;
        }
        return null;
    }

    public function getRepeat($content , $content2){
    
        $array = array();
        foreach($content as $mydata)
        {
            foreach ($content2 as $key => $value) {
                if ($mydata->getCurrencyCode() == $value['code'] ) {
                    array_push($array, array("currency" => $value['currency'], "code" => $value['code'],"mid" => $value['mid']));
                }
            }
        }
        return $array;
     }

     public function getNew($content , $content2){
    
        $array = array();
        foreach($content as $mydata)
        {
            foreach ($content2 as $key => $value) {
                if ($mydata->getCurrencyCode() == $value['code'] ) {
                    unset($content2[$key]);
                }
            }
        }
        foreach ($content2 as $value) {
            array_push($array, array("currency" => $value['currency'], "code" => $value['code'],"mid" => $value['mid']));
        }
        return $array;
     }
    
}