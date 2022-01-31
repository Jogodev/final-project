<?php

namespace App\Repository;

use App\Entity\Cars;
use App\Entity\Categories;
use App\Entity\BookingSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cars[]    findAll()
 * @method Cars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cars::class);
    }


    public function findByQuery(BookingSearch $search): array
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.price', 'ASC');

        if ($search->getMaxPrice()) {
            $query = $query->andWhere('c.price <= :maxPrice')
                ->setParameter('maxPrice', $search->getMaxPrice());
        }
        if ($search->getCategories()) {
            $query = $query->andWhere('c.categories = :category')
                ->setParameter('category', $search->getCategories());
        }
        if ($search->getEnergy()) {
            $query = $query->andWhere('c.energy = :energy')
                ->setParameter('energy', $search->getEnergy());
        }
        //dd($query->getQuery()->getResult());
        
        
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Cars[] Returns an array of Cars objects
    //  */
    /*
    public function findByQuery($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cars
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
