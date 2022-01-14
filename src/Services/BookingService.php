<?php

namespace App\Services;

use App\Entity\Cars;
use App\Entity\Categories;
use App\Entity\Bookings;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function carsList(int $categId = 0): array
    {
        $carslist = $this->em->getRepository(Cars::class)->findAll();
        if($categId!= 0)
        {
            $carsbycateg = $this->em->getRepository(Cars::class)->findBy(['categories'=>$categId]);  
        }
        return $categId === 0 ? $carslist : $carsbycateg;
    }

    public function categoriesList(): array
    {
        $categorieslist = $this->em->getRepository(Categories::class)->findAll();
        return $categorieslist;
    }

    public function bookingsList(): array
    {
        $bookingslist = $this->em->getRepository(Bookings::class)->findAll();
        return $bookingslist;
    }

    
}
