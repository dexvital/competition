<?php

namespace App\Repository;

use App\Entity\GroupsTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupsTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupsTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupsTeam[]    findAll()
 * @method GroupsTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupsTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupsTeam::class);
    }

//    /**
//     * @return GroupsTeam[] Returns an array of GroupsTeam objects
//     */s
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
    public function findOneBySomeField($value): ?GroupsTeam
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
