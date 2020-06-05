<?php

namespace App\Controller;

use App\Entity\Card;
use App\Data\SearchData;
use App\Form\SearchType;
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
    public function index( CardRepository $cardRepository,Request $request)
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $cards = $cardRepository -> findSearch($data);
        return $this->render('card/card.html.twig', [
            'cards' => $cards,
            'form' => $form->createView(),
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
        
    }
}
