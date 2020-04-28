<?php

namespace App\Repository;

use App\Entity\Categori;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categori|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categori|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categori[]    findAll()
 * @method Categori[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categori::class);
    }

    // /**
    //  * @return Categori[] Returns an array of Categori objects
    //  */
    /*
    public function findByExampleField($value)
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
    public function findOneBySomeField($value): ?Categori
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
