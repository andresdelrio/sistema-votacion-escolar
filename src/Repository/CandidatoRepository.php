<?php

namespace App\Repository;

use App\Entity\Candidato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Candidato>
 *
 * @method Candidato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidato[]    findAll()
 * @method Candidato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidato::class);
    }

//    /**
//     * @return Candidato[] Returns an array of Candidato objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Candidato
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
