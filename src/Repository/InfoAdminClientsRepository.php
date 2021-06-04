<?php

namespace App\Repository;

use App\Entity\InfoAdminClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoAdminClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoAdminClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoAdminClients[]    findAll()
 * @method InfoAdminClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoAdminClientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoAdminClients::class);
    }

    // /**
    //  * @return InfoAdminClients[] Returns an array of InfoAdminClients objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoAdminClients
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
