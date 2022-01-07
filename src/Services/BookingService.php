<?php

namespace App\Services;

use App\Entity\Cars;
use App\Entity\Categories;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function carsList(): array
    {
        $carslist = $this->em->getRepository(Cars::class)->findAll();
        return $carslist;
    }

    public function categoriesList(): array
    {
        $categorieslist = $this->em->getRepository(Categories::class)->findAll();
        return $categorieslist;
    }
}
