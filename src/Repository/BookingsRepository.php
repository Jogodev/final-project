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
    
    public function findByDate($car, $startdate, $enddate): bool
    {
        $query = $this->createQueryBuilder('b')
            ->andWhere('b.cars = :cars')
            ->setParameter('cars',$car)
            ->andWhere('b.startDate >= :startDate')
            ->setParameter('startDate', $startdate)
            ->andWhere('b.endDate <= :endDate')
            ->setParameter('endDate', $enddate)
            ->getQuery()
            ->getResult();
        
        ;
        //dd($query);
        return $query == true ? true : false;
    }
    

    /*
    public function findOneBySomeField($value): ?Bookings
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
