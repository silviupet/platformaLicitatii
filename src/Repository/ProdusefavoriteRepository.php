<?php

namespace App\Repository;

use App\Entity\Produsefavorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Produsefavorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produsefavorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produsefavorite[]    findAll()
 * @method Produsefavorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdusefavoriteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Produsefavorite::class);
    }

    // /**
    //  * @return Produsefavorite[] Returns an array of Produsefavorite objects
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
    public function findOneBySomeField($value): ?Produsefavorite
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
