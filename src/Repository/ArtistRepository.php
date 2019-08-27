<?php

namespace App\Repository;

use App\Entity\Artist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    /**
     * @return Artist[] Returns an array of Artist objects
     */

    public function findByExampleField()
    {
        // SOUS-REQUÊTE
        $q1 = $this->createQueryBuilder('x');
        $qexpr = $q1->expr();
        $subrequest = $q1->select('x.id')
            ->where($qexpr->like('x.country', $qexpr->literal('USA')));

        // REQUÊTE PRINCIPALE
        return $this->createQueryBuilder('a')
            ->select('a.name')
            ->innerJoin('a.events', 'e')
            ->where($qexpr->in('a.id', $subrequest->getDQL())) // INJECTION SOUS-REQUÊTE
            ->groupBy('a.id')
            ->getQuery()
            ->getResult()
            ;
    }

   /* public function findByEvents() {
    return $this->createQueryBuilder('a');
        ->orderBy('a.events', 'DESC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
}*/


    /*
    public function findOneBySomeField($value): ?Artist
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
