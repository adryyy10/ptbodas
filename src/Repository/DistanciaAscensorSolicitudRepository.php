<?php

namespace App\Repository;

use App\Entity\DistanciaAscensorSolicitud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DistanciaAscensorSolicitud|null find($id, $lockMode = null, $lockVersion = null)
 * @method DistanciaAscensorSolicitud|null findOneBy(array $criteria, array $orderBy = null)
 * @method DistanciaAscensorSolicitud[]    findAll()
 * @method DistanciaAscensorSolicitud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistanciaAscensorSolicitudRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DistanciaAscensorSolicitud::class);
    }

    // /**
    //  * @return DistanciaAscensorSolicitud[] Returns an array of DistanciaAscensorSolicitud objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DistanciaAscensorSolicitud
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
