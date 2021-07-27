<?php

namespace App\Controller;

use App\Service\Api;
use App\Service\JsonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Api $api, JsonService $jsonService): Response
    {
        $currencyArray =$jsonService->ConvertToArray($api->GetFromAPI('http://api.nbp.pl/api/exchangerates/tables/A?format=JSON'));
        print_r($currencyArray);
        return $this->render('Index/index.html.twig', [
            'message' => 'Index Controller',
        ]);
    }
}
