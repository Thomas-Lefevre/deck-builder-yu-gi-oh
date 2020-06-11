<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }
    /**
     * Récupère les cartes en lien avec une recherche
     * @return Card[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('c')
            ->select('c', 'ct')
            ->innerJoin('c.cardTypes', 'ct')
            ->orderBy('c.nom' , 'ASC');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('c.nom LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->type)) {
            $query = $query
                ->andWhere('ct.id = :type')
                ->setParameter('type', $search->type);
        }

        if (!empty($search->race)) {
            $query = $query
                ->andWhere('c.race = :race')
                ->setParameter('race', $search->race);
        }
        if (!empty($search->level)) {
            $query = $query
                ->andWhere('c.level = :level')
                ->setParameter('level', $search->level);
        }
        if (!empty($search->attribute)) {
            $query = $query
                ->andWhere('c.attribute = :attribute')
                ->setParameter('attribute', $search->attribute);
        }
        if (!empty($search->banlist_info)) {
            $query = $query
                ->andWhere('c.banlist_info = :banlist_info')
                ->setParameter('banlist_info', $search->banlist_info);
        }
        if (!empty($search->archetype)) {
            $query = $query
                ->andWhere('c.archetype = :archetype')
                ->setParameter('archetype', $search->archetype);
        }
        if (!empty($_GET['limit'])) {
            $query = $query->setMaxResults($_GET['limit']);
        }else{
            $query = $query->setMaxResults(50);
        }
        
        return $query->getQuery()->getResult();

    }
}
