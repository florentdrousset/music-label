<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    */
    public function findByEvents() {
        //Requete DQL classique
        /*$q = $this->getEntityManager();
        $query = $q->createQuery('SELECT a.name FROM App\Entity\Event e JOIN e.artist_id a GROUP BY e.artist_id ORDER BY COUNT(e.artist_id) DESC')
        ->setMaxResults(10);
        $result = $query->getResult();*/

        /*return $result;*/

        //Version QueryBuilder
        return $this->createQueryBuilder('e')
            ->select('COUNT(e.artist_id) as maxE, a.name')
            ->innerJoin('App\Entity\Artist', 'a')
            ->where('a.id = e.artist_id')
            ->groupBy('e.artist_id')
            ->orderBy('maxE', 'DESC')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

}
