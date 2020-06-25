<?php
// src/Security/UserVoter.php
namespace App\Security;

use App\Entity\Deck;
use App\Entity\User;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class DeckVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const DEL = 'delete';

    protected function supports( $attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [
            self::VIEW, 
            self::EDIT,
            self::DEL
        ])) {
            return false;
        }

        // only vote on `User` objects
        if (!$subject instanceof Deck) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute( $attribute, $subject, TokenInterface $token)
    {
        $currentUser = $token->getUser();

        if (!$currentUser instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Deck object, thanks to `supports()`
        /** @var Deck $deck */
        $deck = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($deck, $currentUser);
            case self::EDIT:
                return $this->canEdit($deck, $currentUser);
            case self::DEL:
                return $this->canNote($deck, $currentUser);
        }
        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Deck $deck, User $currentUser)
    {
        return true;
    }

    private function canEdit(Deck $deck, User $currentUser)
    {
        return $deck->getUser() === $currentUser;
    }

    private function canNote(Deck $deck, User $currentUser)
    {
        return $deck === $currentUser;
    }
}