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

    
}