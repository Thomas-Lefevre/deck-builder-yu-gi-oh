<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\CardType;
use App\Services\CardManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestAPIController extends AbstractController
{
    private $cardManager;

    public function __construct(CardManager $cardManager)
    {
        $this->cardManager=$cardManager;
    }
    /**
     * @Route("/testapi", name="testapi")
     */
    public function index()
    {
        return $this->render('test_api/testAPI.html.twig', [
            'controller_name' => 'TestAPIController',
        ]);
    }
    /**
     * @Route("/insertCard", name="insertCard")
     */
    public function insertCard(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $id =$this->cardManager->handleInsertCards($data);
        return new JsonResponse(['redirect' => $this->generateUrl("findCard", ['id_api' => $id], UrlGeneratorInterface::ABSOLUTE_URL)], Response::HTTP_OK);
    }
    /**
     * @Route("/insertCardMultiple", name="insertCardMultiple")
     */
    public function insertCardMultiple(Request $request)
    {
        //jsondecode permet de remettre le Json en tableau
        $data = json_decode($request->getContent(), true);
        $this->cardManager->handleInsertCards($data);
        return $this->redirect($this->generateUrl('testapi'));
    }
}
