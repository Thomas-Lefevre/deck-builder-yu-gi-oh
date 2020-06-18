<?php

namespace App\Controller;

use App\Entity\Card;
use App\Services\CardManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ApiController extends AbstractController
{
    private $cardManager;

    public function __construct(CardManager $cardManager)
    {
        $this->cardManager = $cardManager;
    }
    /**
     * @Route("api", name="api")
     */
    public function index()
    {
        return $this->render('api/api.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    /**
     * @Route("/insertCard", name="insertCard")
     */
    public function insertCard(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $id = $this->cardManager->handleInsertCards($data);
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
        return $this->redirect($this->generateUrl('api'));
    }
}
