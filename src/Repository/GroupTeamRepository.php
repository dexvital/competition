<?php

namespace App\Repository;

use App\Entity\GroupTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupTeam[]    findAll()
 * @method GroupTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupTeam::class);
    }

//    /**
//     * @return GroupTeam[] Returns an array of GroupTeam objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupTeam
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
