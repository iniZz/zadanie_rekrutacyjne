<?php

namespace App\Service;

use App\Entity\Currency;

use Doctrine\ORM\EntityManagerInterface;

class CurrencyService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    public function Update($array){

        $queryBuilder = $this->entityManager->getRepository("App\Entity\Currency");
        foreach ($array as $key => $value) {
            $post = $queryBuilder->findOneByCodeField($value['code']);
            $post->setExchangeRate(number_format($value['mid'] , 2));

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }
    }

    public function Insert($array){
        
        foreach ($array as $key => $value) {
            print_r($value);
            $currency = new Currency();
            $currency->setName($value['currency']);
            $currency->setCurrencyCode($value['code']);
            $currency->setExchangeRate(number_format($value['mid'] , 2));

            $this->entityManager->persist($currency);
            $this->entityManager->flush();
        }
    }
}