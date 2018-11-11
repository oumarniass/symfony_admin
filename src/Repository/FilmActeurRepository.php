<?php

namespace App\Repository;

use App\Entity\FilmActeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FilmActeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmActeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmActeur[]    findAll()
 * @method FilmActeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmActeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FilmActeur::class);
    }

    // /**
    //  * @return FilmActeur[] Returns an array of FilmActeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilmActeur
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
