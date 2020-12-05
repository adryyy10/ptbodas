<?php

namespace App\Repository;

use App\Entity\Ascensores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ascensores|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ascensores|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ascensores[]    findAll()
 * @method Ascensores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AscensoresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ascensores::class);
    }

    // /**
    //  * @return Ascensores[] Returns an array of Ascensores objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ascensores
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
