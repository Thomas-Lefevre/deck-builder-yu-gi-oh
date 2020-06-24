<?php

namespace App\Controller;

use App\Repository\DeckRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/deck", name="admin_deck")
     */
    public function indexDeck(DeckRepository $deckRepository)
    {
        return $this->render('admin/adminDeck.html.twig', [
            'decks' => $deckRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user_index", name="user_index", methods={"GET"})
     */
    public function indexUser(UserRepository $userRepository)
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


}
