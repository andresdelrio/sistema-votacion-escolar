<?php

namespace App\Repository;

use App\Entity\Sufragante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sufragante>
 *
 * @method Sufragante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sufragante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sufragante[]    findAll()
 * @method Sufragante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SufraganteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sufragante::class);
    }

//    /**
//     * @return Sufragante[] Returns an array of Sufragante objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sufragante
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
