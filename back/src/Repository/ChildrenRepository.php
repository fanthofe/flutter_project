<?php

namespace App\Repository;

use App\Entity\Children;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Children>
 *
 * @method Children|null find($id, $lockMode = null, $lockVersion = null)
 * @method Children|null findOneBy(array $criteria, array $orderBy = null)
 * @method Children[]    findAll()
 * @method Children[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChildrenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Children::class);
    }

    public function add(Children $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Children $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Count all children
     * @return int
     */
    public function countAllChildren() : int
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count all female children 'f'
     * @return int
     */
    public function countAllFemaleChildren() : int
    {   
        return $this->createQueryBuilder('c')
        ->select('count(c.id)')
        ->where('c.gender = :female')
        ->setParameter('female', 'f')
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAllMaleChildren() : int
    {
        return $this->createQueryBuilder('c')
        ->select('count(c.id)')
        ->where('c.gender = :male')
        ->setParameter('male', 'm')
        ->getQuery()
        ->getSingleScalarResult();
    }

//    /**
//     * @return Children[] Returns an array of Children objects
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

//    public function findOneBySomeField($value): ?Children
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
