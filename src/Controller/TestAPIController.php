<?php

namespace App\Controller;

use App\Entity\Card;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\Error\UndefinedMethodError;
use Symfony\Component\HttpFoundation\Response;

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
    /**
     * @Route("/insertCard", name="insertCard")
     */
    public function insertCard(Request $request)
    {
        //jsondecode permet de remettre le Json en tableau
        $data = json_decode($request->getContent(), true);
        //if qui nous sert a voir si la carte existe déja dans la base de donnée
        if ($this->getDoctrine()->getRepository(Card::class)->findOneBy(["id_api" => $data['id']])) {
            return new Response('ok', Response::HTTP_OK);
        } else {
            if ($data -> exists($data['linkval'])) {
                dump($data['linkval']);
            } else {
                echo('Nickel');
            }

            die;
            //si la existe pas il faut la créer
            $card = new Card();
            $card->setIdApi($data['id']);
            $card->setNom($data['name']);
            $card->setDescription($data['desc']);
            $card->setType($data['type']);
            $card->setAttribute($data['attribute']);
            $card->setRace($data['race']);
            $card->setPrice($data['card_prices'][0]['cardmarket_price']);
            $card->setArchetype($data['archetype']);
            $card->setSetName($data['card_sets'][0]['set_name']);
            $card->setSetCode($data['card_sets'][0]['set_code']);
            $card->setSetRarity($data['card_sets'][0]['set_rarity']);
            //$card->setBanlistInfo($data['banlist_info']['ban_tcg']);
            //$card->setAtkDefLvl($data['atk'], $data['def'], $data['level']);
            //$card->setLinkMarkers($data['linkmarkers']);
            //$card->setLinkVal($data['linkval']);

            $card->setImg($data['card_images'][0]['image_url']);
            $card->setImgMinia($data['card_images'][0]['image_url_small']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($card);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('testapi'));
            //persist
            //flush
        }
    }
}
