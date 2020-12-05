<?php

namespace App\Repository;

use App\Entity\Peticiones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Peticiones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peticiones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peticiones[]    findAll()
 * @method Peticiones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeticionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peticiones::class);
    }

    // /**
    //  * @return Peticiones[] Returns an array of Peticiones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Peticiones
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
