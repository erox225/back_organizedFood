<?php

namespace App\Repository;

use App\Entity\RecetaHogar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecetaHogar>
 *
 * @method RecetaHogar|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecetaHogar|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecetaHogar[]    findAll()
 * @method RecetaHogar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetaHogarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecetaHogar::class);
    }

    public function obtenerRecetasYDiasSemanaDeHogar(EntityManagerInterface $entityManager, Hogar $hogar)
{
    $queryBuilder = $entityManager->createQueryBuilder();

    $recetasYDiasSemana = $queryBuilder
        ->select('r.nombre as recetaNombre', 'rh.diasemana')
        ->from('App\Entity\Hogar', 'h')
        ->join('h.recetasHogar', 'rh')
        ->join('rh.receta', 'r')
        ->where('h.id = :hogarId')
        ->setParameter('hogarId', $hogar->getId())
        ->getQuery()
        ->getResult();

    return $recetasYDiasSemana;
}

//    /**
//     * @return RecetaHogar[] Returns an array of RecetaHogar objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RecetaHogar
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
