<?php

namespace App\Controller;

use App\Repository\DeckRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDeckController extends AbstractController
{
    /**
     * @Route("/admin/deck", name="admin_deck")
     */
    public function index(DeckRepository $deckRepository)
    {
        return $this->render('admin_deck/adminDeck.html.twig', [
            'decks' => $deckRepository->findAll(),
        ]);
    }
}
