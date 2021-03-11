<?php

namespace App\Repository;

use App\Entity\PropertySearch;
use App\Entity\Proprietes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Proprietes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprietes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprietes[]
 * @method Proprietes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprietesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprietes::class);
    }
    /**
     * @return array|Query
     */
    public function findAll()
    {
            $query = $this->findVisibleQuery();
            return  $query->getQuery()
                     ->setMaxResults(20)
                    ->getResult();
    }
    public function countdvd()
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql='SELECT Count(*) as dvd FROM proprietes';
        $prepare = $connection->prepare($sql);
        $prepare->execute();

        return $prepare->fetch();
    }

    /**
     * @return Proprietes[]
     */
    public function findAllvisible(PropertySearch $search)
     {
        $query =  $this->findVisibleQuery();
        if($search->getMaxprix())
     {
         $query = $query
             ->andwhere('p.prix <= :maxprix')
             ->setParameter('maxprix', $search->getMaxprix());
     }
         if($search->getTitre())
         {
             $query = $query
                 ->andwhere('p.titre = :titrefilm')
                 ->setParameter('titrefilm', $search->getTitre());
         }
           return  $query->getQuery()
                        ->getResult();
    }
    public  function findLatest(PropertySearch $search)
    {
        $query =  $this->findVisibleQuery();

        if($search->getMaxprix())
        {
            $query = $query
                ->andwhere('p.prix <= :maxprix')
                ->setParameter('maxprix', $search->getMaxprix());
        }
        if($search->getTitre())
        {
            $query = $query
                ->andwhere('p.titre = :titrefilm')
                ->setParameter('titrefilm', $search->getTitre());
        }
        return  $query->getQuery()
                ->setMaxResults(10)
                 ->getResult()
                                 ;
    }
    public function findcategori($value)
    {
        $query = $this->findVisibleQuery();
    }

    public  function findAction(PropertySearch $search)
    {
        $query =  $this->findVisibleQuery();
    }
    public function findTop()
    {
        return $this->createQueryBuilder('p')
                    ->where('p.top_film = true')
                    ->getQuery()
                    ->getResult();
    }
    public function findnew()
    {
        return $this->createQueryBuilder('p')
                    ->where('p.newfilm = true')
                    ->getQuery()
                    ->getResult();
    }


    /**
     * @return QueryBuilder
     */
    private function findVisibleQuery()
    {
        return $this->createQueryBuilder('p')
             ->orderBy('p.id', 'DESC');
    }




    // /**
    //  * @return Proprietes[] Returns an array of Proprietes objects
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
    public function findOneBySomeField($value): ?Proprietes
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
