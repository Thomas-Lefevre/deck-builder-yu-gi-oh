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

     /**
     * @return Deck[] Returns an array of Deck objects
     */
    public function cardsInDeck($idDeck)
    {
        $query = $this
            ->createQueryBuilder('d')
            ->select('SUM(dc.nbr)')
            ->innerJoin('d.deckCards', 'dc')
            ->andWhere('d.id = :id')
            ->setParameter('id', $idDeck);
        return $query->getQuery()->getSingleScalarResult();
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
