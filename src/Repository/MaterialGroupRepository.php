<?php

namespace App\Repository;

use App\Entity\MaterialGroup;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
/**
 * @method MaterialGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterialGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterialGroup[]    findAll()
 * @method MaterialGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialGroupRepository extends NestedTreeRepository
{
    // /**
    //  * @return MaterialGroup[] Returns an array of MaterialGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaterialGroup
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
