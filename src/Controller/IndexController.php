<?php

namespace App\Controller;

use App\Service\Api;
use App\Service\JsonService;
use App\Service\CurrencyService;

use App\Entity\Currency;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Api $api, JsonService $jsonService, CurrencyService $currencyService): Response
    {
        $currencyArray =$jsonService->ConvertToArray($api->GetFromAPI('http://api.nbp.pl/api/exchangerates/tables/A?format=JSON'));
        if ($currencyArray != null) {
            $currencyAll= $this->getDoctrine()->getRepository(Currency::class)->findAll();

            $currencyRepeat = $jsonService->getRepeat($currencyAll, $currencyArray);
            
            if (count($currencyRepeat)!=0) {
                $currencyService->Update($currencyRepeat);
            }
    
            $currencyNew = $jsonService->getNew($currencyAll, $currencyArray);
            
            if (count($currencyNew)>0) {
                $currencyService->Insert($currencyNew);
            }
        }
        

        return $this->render('Index/index.html.twig', [
            'message' => 'Index Controller',
            'currency' => $currencyArray,
        ]);
    }
}
