<?php

namespace App\Repository;

use App\Entity\Deck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deck|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deck|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deck[]    findAll()
 * @method Deck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deck::class);
    }

    // /**
    //  * @return Deck[] Returns an array of Deck objects
    //  */
    public function cardsInDeck()
    {
        $query = $this
            ->createQueryBuilder('c')
            ->select('c', 'd', 'dc')
            ->innerJoin('c.deckCard', 'dc')
            ->innerJoin('dc.deck', 'd')
            ->orderBy('c.nom' , 'ASC');
        return $query->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Deck
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
