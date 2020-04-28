<?php

namespace App\Repository;

use App\Entity\PropertySearch;
use App\Entity\Proprietes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Proprietes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprietes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprietes[]    findAll()
 * @method Proprietes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprietesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprietes::class);
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


    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function findVisibleQuery()
    {
        return $this->createQueryBuilder('p')
            ->where('p.solde = false');
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
