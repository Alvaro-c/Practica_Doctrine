<?php

namespace App\Repository;

use App\Entity\Jugadorbidireccional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Jugadorbidireccional|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jugadorbidireccional|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jugadorbidireccional[]    findAll()
 * @method Jugadorbidireccional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JugadorbidireccionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jugadorbidireccional::class);
    }

    // /**
    //  * @return Jugador[] Returns an array of Jugador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jugador
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
