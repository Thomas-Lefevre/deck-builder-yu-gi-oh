<?php

namespace App\Controller;

use App\Repository\CardRepository;
use App\Repository\DeckRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CardRepository $cardRepository, DeckRepository $deckRepository)
    {
        $randomCard = $cardRepository->findAleaCard();
        $randomDeck = $deckRepository->findAleaDeck();
        $newDeck = $deckRepository ->findAll();

        return $this->render('home/home.html.twig', [
            'card'=>$randomCard,
            'newDeck' => $newDeck,
            'randomDeck'=>$randomDeck,
            'controller_name' => 'HomeController',
        ]);
    }
}
