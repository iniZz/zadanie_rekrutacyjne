<?php

namespace App\Controller;

use App\Service\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Api $api): Response
    {
        $currencyArray = $api->GetFromAPI('http://api.nbp.pl/api/exchangerates/tables/A?format=JSON');
        return $this->render('Index/index.html.twig', [
            'message' => 'Index Controller',
        ]);
    }
}
