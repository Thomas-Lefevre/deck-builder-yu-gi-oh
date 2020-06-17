<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Deck;
use App\Form\DeckType;
use App\Data\SearchData;
use App\Entity\DeckCard;
use App\Form\SearchType;
use App\Repository\CardRepository;
use App\Repository\DeckRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/deck")
 */
class DeckController extends AbstractController
{
    /**
     * @Route("/", name="deck_index", methods={"GET"})
     */
    public function index(DeckRepository $deckRepository): Response
    {
        return $this->render('deck/index.html.twig', [
            'decks' => $deckRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="deck_new", methods={"GET","POST"})
     */
    function new (UserInterface $user , Request $request): Response 
    {
        $deck = new Deck();
        $deck->setNom('Deck name');
        $deck->setAuteur($user->getUsername());
        $deck->setFormat('Classic');
        $deck->setNote(0);
        $deck->setPrix(0);
        $deck->setType('Fun');
        $deck->setImg('');
        $deck->setDatePost(new \Datetime());
        $deck->setIdUser($user);

        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($deck);
        $entityManager->flush();
        $id  = $deck->getId();
        return $this->redirectToRoute('deck_edit', ['id' => $id]);

    }

    /**
     * @Route("/{id}", name="deck_show", methods={"GET"})
     */
    public function show(Deck $deck): Response
    {
        return $this->render('deck/show.html.twig', [
            'deck' => $deck,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deck_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Deck $deck,CardRepository $cardRepository): Response
    {
        $data = new SearchData();
        $newDeckForm = $this->createForm(DeckType::class, $deck);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $cards = $cardRepository->findSearch($data);
        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('deck/_cards.html.twig', ['cards' => $cards]),
            ]);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deck_index');
        }

        return $this->render('deck/edit.html.twig', [
            'cards' => $cards,
            'deck' => $deck,
            'form' => $form->createView(),
            'newDeckForm' => $newDeckForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deck_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Deck $deck): Response
    {
        if ($this->isCsrfTokenValid('delete' . $deck->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deck);
            $entityManager->flush();
        }

        return $this->redirectToRoute('deck_index');
    }

    /**
     * @Route("/cardInDeck/{id_deck}/{id_card}", name="card_in_deck", methods={"GET","POST"})
     * @ParamConverter("deck",options={"id"= "id_deck"})
     * @ParamConverter("card",options={"id"= "id_card"})
     */

    public function cardInDeck(Request $request, Deck $deck ,Card  $card)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $deckCard = $entityManager->getRepository(DeckCard::class)->findOneBy(["deck" => $deck , "card"=> $card] );
        if($deckCard){
            $nbr = $deckCard->getNbr();
            if($nbr < 3 ){
                $nbr ++;
                $deckCard->setNbr($nbr);
            }
        }else{
            $deckCard = new DeckCard();
            $deckCard->setDeck($deck);
            $deckCard->setCard($card);
            $deckCard->setNbr(1);
            $entityManager->persist($deckCard);
        }  
        $entityManager->flush();
        
        return $this->redirectToRoute('deck_edit', ['id' => $deck->getId()]);
    }

}
