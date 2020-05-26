<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestAPIController extends AbstractController
{
    /**
     * @Route("/testapi", name="testapi")
     */
    public function index()
    {
        return $this->render('test_api/testAPI.html.twig', [
            'controller_name' => 'TestAPIController',
        ]);
    }
}
