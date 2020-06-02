<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/card")
 */
class CardController extends AbstractController
{
    /**
     * @Route("/", name="card")
     */
    public function index()
    {
        return $this->render('card/card.html.twig', [
            'controller_name' => 'CardController',
0        ]);
    }
    /**
     * @Route("/{id_api}", name="findCard", methods={"GET"})
     */
    public function findCard(Card $card)
    {
        return $this->render('card/findCard.html.twig', [
            'card' => $card,
        ]);
    }
    /**
     * @Route("/search", name="search_card")
     */
    public function searchCard(Request $request, CardRepository $cardRepository)
    {
        $cards = [];
        $searchCardForm = $this->createForm(CardType::class, $cards);


        if ($searchCardForm->handleRequest($request)->isSubmitted() && $searchCardForm->isValid()) {
            $searchCard = $searchCardForm->getData();
            $cards = $cardRepository->searchCard($searchCard);
        }
        return $this->render('card/card.html.twig', [
            'searchCardForm' => $searchCardForm->createView(),
            'cards' => $cards,
        ]);
    }
}
