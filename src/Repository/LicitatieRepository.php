<?php

namespace App\Repository;

use App\Entity\Licitatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Licitatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licitatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licitatie[]    findAll()
 * @method Licitatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicitatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licitatie::class);
    }

    // /**
    //  * @return Licitatie[] Returns an array of Licitatie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Licitatie
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
