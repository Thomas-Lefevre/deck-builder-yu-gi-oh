<?php
// src/Security/UserVoter.php
namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const NOTE = 'note';

    protected function supports( $attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [
            self::VIEW, 
            self::EDIT,
            self::NOTE
        ])) {
            return false;
        }

        // only vote on `User` objects
        if (!$subject instanceof User) {
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

        // you know $subject is a User object, thanks to `supports()`
        /** @var User $user */
        $user = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($user, $currentUser);
            case self::EDIT:
                return $this->canEdit($user, $currentUser);
            case self::NOTE:
                return $this->canNote($user, $currentUser);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $user, User $currentUser)
    {
        // // if they can edit, they can view
        // if ($this->canEdit($post, $user)) {
        //     return true;
        // }

        // // the Post object could have, for example, a method `isPrivate()`
        // return !$post->isPrivate();
    }

    private function canEdit(User $user, User $currentUser)
    {
        // // this assumes that the Post object has a `getOwner()` method
        // return $user === $post->getOwner();
    }

    private function canNote(User $user, User $currentUser)
    {
        return $user === $currentUser;
    }
}