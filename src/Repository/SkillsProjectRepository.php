<?php

namespace App\Repository;

use App\Entity\SkillsProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SkillsProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillsProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillsProject[]    findAll()
 * @method SkillsProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillsProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillsProject::class);
    }

    // /**
    //  * @return SkillsProject[] Returns an array of SkillsProject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SkillsProject
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
