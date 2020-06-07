<?php

namespace App\Repository;

use App\Entity\Apparaat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apparaat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apparaat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apparaat[]    findAll()
 * @method Apparaat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApparaatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apparaat::class);
    }

    // /**
    //  * @return Apparaat[] Returns an array of Apparaat objects
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
    public function findOneBySomeField($value): ?Apparaat
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
