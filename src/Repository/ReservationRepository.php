<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }
    public function countreserv()
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql='SELECT Count(*) as reserv FROM Reservation';
        $prepare = $connection->prepare($sql);
        $prepare->execute();

        return $prepare->fetch();
    }
    public function findReserv()
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql='SELECT username , reservation.id , email,telephone ,titre    FROM Reservation , user ,proprietes WHERE user.id=reservation.iduser_id AND proprietes.id = reservation.idproprietes_id';
        $prepare = $connection->prepare($sql);
        $prepare->execute();

        return $prepare->fetchAll();
    }
   
    

    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
