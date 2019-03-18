<?php

namespace App\Repository;

use App\Entity\Passengers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Passengers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passengers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passengers[]    findAll()
 * @method Passengers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Passengers::class);
    }

    // /**
    //  * @return Passengers[] Returns an array of Passengers objects
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
    public function findOneBySomeField($value): ?Passengers
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
