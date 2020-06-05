<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
        $card = $this->getDoctrine()->getRepository(Card::class)->findOneBy(["id_api" => $data['id']]);
        if ($card) {
        } else {
            //dump($data);
            //die;
            //si la existe pas il faut la créer
            $card = new Card();
            $card->setIdApi($data['id']);
            $card->setNom($data['name']);
            $card->setDescription($data['desc']);

            if (!empty($data['type'])) {
                $types = explode(' ', $data['type']);
                foreach ($types as $type) {
                    switch ($type) {
                        case 'Card':
                            //continue 2 car continue est considere comme un break
                            continue 2;
                        case 'Spell':
                            $entity = $this->getDoctrine()->getRepository(CardType::class)->findOneBy(["name" => 'Spell Card']);
                            break;
                        case 'Trap':
                            $entity = $this->getDoctrine()->getRepository(CardType::class)->findOneBy(["name" => 'Trap Card']);
                            break;
                        default:
                            $entity = $this->getDoctrine()->getRepository(CardType::class)->findOneBy(["name" => $type]);
                    }
                    if ($entity) {
                        $card->addCardType($entity);
                    }
                }
            }
            if (!empty($data['attribute'])) {
                $card->setAttribute($data['attribute']);
            }
            if (!empty($data['race'])) {

                $card->setRace($data['race']);
            }
            if (!empty($data['card_prices'][0]['cardmarket_price'])) {
                $card->setPrice($data['card_prices'][0]['cardmarket_price']);
            }
            if (!empty($data['archetype'])) {
                $card->setArchetype($data['archetype']);
            }
            if (!empty($data['card_sets'][0]['set_name'])) {
                $card->setSetName($data['card_sets'][0]['set_name']);
            }
            if (!empty($data['card_sets'][0]['set_code'])) {
                $card->setSetCode($data['card_sets'][0]['set_code']);
            }
            if (!empty($data['card_sets'][0]['set_rarity'])) {
                $card->setSetRarity($data['card_sets'][0]['set_rarity']);
            }
            if (!empty($data['banlist_info']['ban_tcg'])) {
                $card->setBanlistInfo($data['banlist_info']['ban_tcg']);
            }
            if (!empty($data['atk'])) {
                $card->setAtk($data['atk']);
            }
            if (!empty($data['def'])) {
                $card->setDef($data['def']);
            }
            if (!empty($data['level'])) {
                $card->setLevel($data['level']);
            }
            if (!empty($data['linkmarkers'])) {
                $card->setLinkMarkers($data['linkmarkers']);
            }
            if (!empty($data['linkval'])) {
                $card->setLinkVal($data['linkval']);
            }
            $url = $data['card_images'][0]['image_url'];
            $img = "img/card/" . $data['id'] . ".jpeg";
            // Enregistrer l'image normale
            file_put_contents($img, file_get_contents($url));
            $card->setImg($img);
            $url_minia = $data['card_images'][0]['image_url_small'];
            $img_minia = "img/card_minia/" . $data['id'] . "_small.jpeg";
            // Enregistrer l'image miniature
            file_put_contents($img_minia, file_get_contents($url_minia));
            $card->setImgMinia($img_minia);

            //persist
            //flush
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($card);

            $entityManager->flush();
        }
        $id = $card->getIdApi();
        return new JsonResponse(['redirect' => $this->generateUrl("findCard", ['id_api' => $id], UrlGeneratorInterface::ABSOLUTE_URL)], Response::HTTP_OK);
    }
    /**
     * @Route("/insertCardMultiple", name="insertCardMultiple")
     */
    public function insertCardMultiple(Request $request)
    {

        //jsondecode permet de remettre le Json en tableau
        $data = json_decode($request->getContent(), true);
        // on stocke le count($data) dans une variable pour que
        // le for ne le recalcule pas a chaque tout de boucle
        // le \ sert a ce que la fonction s'éxécute plus vite et appelle celle implémentée dans namespace global de php
        $dataLength = \count($data);
        // count($data) sert ici a s'arreter quand il a lu loutes les valeurs du tableau de données que l'api nous donne
        for ($i = 0; $i < $dataLength; $i++) {
            # code...
            //if qui nous sert a voir si la carte existe déja dans la base de donnée
            $card = $this->getDoctrine()->getRepository(Card::class)->findOneBy(["id_api" => $data[$i]['id']]);
            if ($card) {
            } else {
                //si elle existe pas il faut la créer

                $card = new Card();
                $card->setIdApi($data[$i]['id']);
                $card->setNom($data[$i]['name']);
                $card->setDescription($data[$i]['desc']);

                if (!empty($data[$i]['type'])) {
                    $types = explode(' ', $data[$i]['type']);
                    foreach ($types as $type) {
                        switch ($type) {
                            case 'Card':
                                //continue 2 car continue est considere comme un break
                                continue 2;
                            case 'Spell':
                                $entity = $this->getDoctrine()->getRepository(CardType::class)->findOneBy(["name" => 'Spell Card']);
                                break;
                            case 'Trap':
                                $entity = $this->getDoctrine()->getRepository(CardType::class)->findOneBy(["name" => 'Trap Card']);
                                break;
                            default:
                                $entity = $this->getDoctrine()->getRepository(CardType::class)->findOneBy(["name" => $type]);
                        }
                        if ($entity) {
                            $card->addCardType($entity);
                        }
                    }
                }
                if (!empty($data[$i]['attribute'])) {
                    $card->setAttribute($data[$i]['attribute']);
                }
                if (!empty($data[$i]['race'])) {

                    $card->setRace($data[$i]['race']);
                }
                if (!empty($data[$i]['card_prices'][0]['cardmarket_price'])) {
                    $card->setPrice($data[$i]['card_prices'][0]['cardmarket_price']);
                }
                if (!empty($data[$i]['archetype'])) {
                    $card->setArchetype($data[$i]['archetype']);
                }
                if (!empty($data[$i]['card_sets'][0]['set_name'])) {
                    $card->setSetName($data[$i]['card_sets'][0]['set_name']);
                }
                if (!empty($data[$i]['card_sets'][0]['set_code'])) {
                    $card->setSetCode($data[$i]['card_sets'][0]['set_code']);
                }
                if (!empty($data['card_sets'][0]['set_rarity'])) {
                    $card->setSetRarity($data[$i]['card_sets'][0]['set_rarity']);
                }
                if (!empty($data[$i]['banlist_info']['ban_tcg'])) {
                    $card->setBanlistInfo($data[$i]['banlist_info']['ban_tcg']);
                }
                if (!empty($data[$i]['atk'])) {
                    $card->setAtk($data[$i]['atk']);
                }
                if (!empty($data[$i]['def'])) {
                    $card->setDef($data[$i]['def']);
                }
                if (!empty($data[$i]['level'])) {
                    $card->setLevel($data[$i]['level']);
                }
                if (!empty($data[$i]['linkmarkers'])) {
                    $card->setLinkMarkers($data[$i]['linkmarkers']);
                }
                if (!empty($data[$i]['linkval'])) {
                    $card->setLinkVal($data[$i]['linkval']);
                }
                $url = $data[$i]['card_images'][0]['image_url'];
                $img = "img/card/" . $data[$i]['id'] . ".jpeg";
                // Enregistrer l'image normale
                file_put_contents($img, file_get_contents($url));
                $card->setImg($img);
                $url_minia = $data[$i]['card_images'][0]['image_url_small'];
                $img_minia = "img/card_minia/" . $data[$i]['id'] . "_small.jpeg";
                // Enregistrer l'image miniature
                file_put_contents($img_minia, file_get_contents($url_minia));
                $card->setImgMinia($img_minia);
                //persist
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($card);
            }
        }

        //flush
        if (!empty($entityManager)) {
            $entityManager->flush();
        }
        return $this->redirect($this->generateUrl('testapi'));
    }
}
