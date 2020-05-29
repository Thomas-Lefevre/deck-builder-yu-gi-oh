<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function index()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }
    /**
     * @Route("/recherche", name="recherche_card")
     */
    public function searchCard(Request $request, CardRepository $cardRepository)
    {
        $cards = [];
        $searchCardForm = $this->createForm(CardRepository::class);

        if ($searchCardForm->handleRequest($request)->isSubmitted() && $searchCardForm->isValid()) {
            $searchCard = $searchCardForm->getData();
            $cards = $cardRepository ->rechercheTrajet($searchCard);            
        }
        return $this->render('recherche_trajet/recherche.html.twig', [
            'searchCardForm' => $searchCardForm->createView(),
            'cards'=> $cards,
        ]);
    }
}
