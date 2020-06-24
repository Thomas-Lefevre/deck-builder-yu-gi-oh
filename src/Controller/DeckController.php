<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Deck;
use App\Entity\Note;
use App\Entity\User;
use App\Form\DeckType;
use App\Data\SearchData;
use App\Entity\DeckCard;
use App\Form\SearchType;
use App\Security\UserVoter;
use App\Repository\CardRepository;
use App\Repository\DeckRepository;
use App\Repository\NoteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/deck")
 */
class DeckController extends AbstractController
{
    /**
     * @Route("/allDeck", name="all_deck", methods={"GET"})
     */

    public function allDeck(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Deck::class)->findBy([],['id' => 'desc']);

        $deck = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );
        
        return $this->render('deck/allDeck.html.twig', [
            'decks' => $deck,
        ]);
    }
    /**
     * @Route("/myDeck", name="my_deck", methods={"GET"})
     */
    public function myDeck(Request $request, DeckRepository $deckRepository, PaginatorInterface $paginator): Response
    {
                // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
                $donnees = $this->getDoctrine()->getRepository(Deck::class)->findBy(["id_user" => $this->getUser()->getId()],['id' => 'desc']);

                $deck = $paginator->paginate(
                    $donnees, // Requête contenant les données à paginer (ici nos articles)
                    $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                    12 // Nombre de résultats par page
                );
        
        return $this->render('deck/myDeck.html.twig', [
            'decks' => $deck,

        ]);
    }

    // public function index(DeckRepository $deckRepository): Response
    // {
    //     return $this->render('deck/index.html.twig', [
    //         'decks' => $deckRepository->findAll(),
    //     ]);
    // }

    /**
     * @Route("/new", name="deck_new", methods={"GET","POST"})
     */
    function new (UserInterface $user, Request $request): Response {
        $deck = new Deck();
        $deck->setNom('Deck name');
        $deck->setAuteur($user->getUsername());
        $deck->setFormat('Classic');
        $deck->setPrix(0);
        $deck->setType('Fun');
        $deck->setImg('img/card/defaultCard.jpg');
        $deck->setDatePost(new \Datetime());
        $deck->setIdUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($deck);
        $entityManager->flush();
        $id = $deck->getId();
        return $this->redirectToRoute('deck_edit', ['id' => $id]);

    }

    /**
     * @Route("/{id}", name="deck_show", methods={"GET"})
     */
    public function show(Deck $deck, NoteRepository $noteRepository): Response
    {
        $idDeck = $deck->getId();
        $note = $noteRepository->noteDeck($idDeck);

        return $this->render('deck/show.html.twig', [
            'note'=>$note,
            'deck' => $deck,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deck_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Deck $deck, CardRepository $cardRepository, DeckRepository $deckRepository): Response
    {
        $data = new SearchData();
        $newDeckForm = $this->createForm(DeckType::class, $deck);
        $form = $this->createForm(SearchType::class, $data);
        $newDeckForm->handleRequest($request);
        $cards = $cardRepository->findSearch($data);
        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('deck/_cards.html.twig', ['cards' => $cards, 'deck' => $deck]),
            ]);
        }

        if ($newDeckForm->isSubmitted() && $newDeckForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deck_edit', ['id' => $deck->getId()]);
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

        return $this->redirectToRoute('my_deck');
    }

    /**
     * @Route("/cardInDeck/{id_deck}/{id_card}", name="insert_card_in_deck", methods={"GET","POST"})
     * @ParamConverter("deck",options={"id"= "id_deck"})
     * @ParamConverter("card",options={"id"= "id_card"})
     */

    public function insertCardInDeck(Request $request, Deck $deck, Card $card, DeckRepository $deckRepository)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $deckCard = $entityManager->getRepository(DeckCard::class)->findOneBy(["deck" => $deck, "card" => $card]);
        $idDeck = $deck->getId();
        $nbrCard = $deckRepository->cardsInDeck($idDeck);
        if ($nbrCard < 60) {
            if ($deckCard) {
                $nbr = $deckCard->getNbr();
                if ($nbr < 3) {
                    $nbr++;
                    $deckCard->setNbr($nbr);
                }
            } else {
                $deckCard = new DeckCard();
                $deckCard->setDeck($deck);
                $deckCard->setCard($card);
                $deckCard->setNbr(1);
                $entityManager->persist($deckCard);
            }
            $entityManager->flush();
        }
        return $this->redirectToRoute('deck_edit', ['id' => $deck->getId()]);
    }
    /**
     * @Route("/removeCardInDeck/{id_deck}/{id_card}", name="remove_card_in_deck", methods={"GET","POST"})
     * @ParamConverter("deck",options={"id"= "id_deck"})
     * @ParamConverter("card",options={"id"= "id_card"})
     */

    public function removeCardInDeck(Request $request, Deck $deck, Card $card)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $deckCard = $entityManager->getRepository(DeckCard::class)->findOneBy(["deck" => $deck, "card" => $card]);
        if ($deckCard) {
            $nbr = $deckCard->getNbr();
            $nbr--;
            if ($nbr === 0) {
                $entityManager->remove($deckCard);
            } else {
                $deckCard->setNbr($nbr);
            }

            $entityManager->flush();

        }

        return $this->redirectToRoute('deck_edit', ['id' => $deck->getId()]);
    }
    /**
     * @Route("/show_deck/{id_deck}/{id_user}/{note}", name="note", methods={"GET","POST"} , requirements={"note"="-1|1"})
     * @ParamConverter("deck",options={"id"= "id_deck"})
     * @ParamConverter("user",options={"id"= "id_user"})
     */

    public function note(Request $request, Deck $deck, User $user, int $note)
    {
        $this->denyAccessUnlessGranted(UserVoter::NOTE , $user);

        $entityManager = $this->getDoctrine()->getManager();
        $noteEntity = $entityManager->getRepository(Note::class)->findOneBy(["deck" => $deck, "user" => $user]);
        
        if (!$noteEntity){
            $noteEntity = new Note();
            $noteEntity->setUser($user);
            $noteEntity->setDeck($deck);
            $entityManager->persist($noteEntity);
        }
        $noteEntity->setNote($note);

        $entityManager->flush();

        return $this->redirectToRoute('deck_show', ['id' => $deck->getId()]);
    }
}
