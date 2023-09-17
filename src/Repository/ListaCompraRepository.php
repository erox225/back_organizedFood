<?php

namespace App\Repository;

use App\Entity\ListaCompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListaCompra>
 *
 * @method ListaCompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListaCompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListaCompra[]    findAll()
 * @method ListaCompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListaCompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListaCompra::class);
    }

//    /**
//     * @return ListaCompra[] Returns an array of ListaCompra objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ListaCompra
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
