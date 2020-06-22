<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CardRepository $cardRepository)
    {
        $card = $cardRepository -> findAlea();
        return $this->render('home/index.html.twig', [
            'card'=>$card,
            'controller_name' => 'HomeController',
        ]);
    }
}
