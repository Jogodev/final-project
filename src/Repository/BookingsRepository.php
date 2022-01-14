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
     * @return Bookings[] Returns an array of Bookings objects
     */
    
    public function findByDate(int $car, $date1, $date2): ?Bookings
    {
        $query = $this->createQueryBuilder('b')
            ->andWhere('b.cars = :val')
            ->andWhere('b.startDate >= $date1')
            ->andWhere('b.endDate <= $date2')
            ->setParameter('val', $value)
            ->getQuery()
           
        ;
        dd($query);
        //return $compare == null ? null: $compare;
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
