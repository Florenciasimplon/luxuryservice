<?php

namespace App\Repository;

use App\Entity\JobOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobOffer[]    findAll()
 * @method JobOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobOffer::class);
    }
    public function getPreviousJob($job){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT  
                job_offer
             FROM App\Entity\JobOffer job_offer
             WHERE job_offer.creation_date < :date 
             ORDER BY job_offer.id DESC
            '
            )->setParameter('date', $job->getCreationDate())->setMaxResults(1);
        return $query->getResult();
    }
    
    public function getNextJob($job){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT  
                job_offer
             FROM App\Entity\JobOffer job_offer
             WHERE job_offer.creation_date > :date 
             ORDER BY job_offer.id ASC
            '
            )->setParameter('date', $job->getCreationDate())->setMaxResults(1);
        return $query->getResult();

    }

    // /**
    //  * @return JobOffer[] Returns an array of JobOffer objects
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
    public function findOneBySomeField($value): ?JobOffer
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
