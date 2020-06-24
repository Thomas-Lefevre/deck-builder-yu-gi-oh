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
        $card = $cardRepository->findAleaCard();
        $deck = $deckRepository->findAleaDeck();
        return $this->render('home/index.html.twig', [
            'card'=>$card,
            'deck'=>$deck,
            'controller_name' => 'HomeController',
        ]);
    }
}
