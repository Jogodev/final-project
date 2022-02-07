<?php

namespace App\Repository;

use App\Entity\Bookings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bookings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookings[]    findAll()
 * @method Bookings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookings::class);
    }

    /**
     * @return Boolean
     */
        
    /**
     * Method findByDate
     *
     * @param $car $car [explicite description]
     * @param $startdate $startdate [explicite description]
     * @param $enddate $enddate [explicite description]
     *
     * @return 
     */
    public function findByDate($car, $startdate, $enddate)
    {
        $query = $this->createQueryBuilder('b')
            ->andWhere('b.cars = :cars')           
            //Si la date de début est superieure ou égal à la date de debut de la bdd mais qu'elle est inferieur à la date de fin           
            ->andWhere('(:startDate >= b.startDate')
            ->andWhere(':startDate <= b.endDate)')
            //Si la date de fin est superieur à la date de début de la bdd mais inférieur ou égal à la date de fin           
            ->orWhere('(:endDate >= b.startDate')
            ->andWhere(':endDate <= b.endDate)')
            ->andWhere('b.cars = :cars')
            //Si nos 2 dates sont entre la date de début et la date de fin de la bdd           
            ->orWhere('(:startDate <= b.startDate')
            ->andWhere(':endDate >= b.endDate)')
            ->andWhere('b.cars = :cars')
            ->setParameter('cars',$car)
            ->setParameter('endDate', $enddate)
            ->setParameter('startDate', $startdate)
            ->getQuery()
            ->getResult();
            //dd($query);
        
        ;
        return $query;
        
        
    }
    
}
