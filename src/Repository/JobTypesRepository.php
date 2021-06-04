<?php

namespace App\Repository;

use App\Entity\JobTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobTypes[]    findAll()
 * @method JobTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobTypes::class);
    }

    // /**
    //  * @return JobTypes[] Returns an array of JobTypes objects
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
    public function findOneBySomeField($value): ?JobTypes
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
