<?php

namespace Tekstove\TekstoveBundle\Model\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Tekstove\TekstoveBundle\Model\User;
use Tekstove\TekstoveBundle\Model\Lyric;

/**
 * Description of Lyric
 *
 * @author potaka
 */
class LyricVoter implements VoterInterface
{
    public function supportsAttribute($attribute)
    {
        return null;
    }

    public function supportsClass($class)
    {
        if ($class instanceof Lyric) {
            return true;
        }
        
        return false;
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        if (!$this->supportsClass($object)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }
        
        /* @var $object Model\Lyric */
        
        switch ($attributes[0]) {
            case 'edit':
                $user = $token->getUser();
                /* @var $user Model\User */
                // @TODO @FIX @ FIXME
                if (0 && $user instanceof User && $user->getId() === $object->getUploader()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                
                foreach ($token->getRoles() as $role) {
                    /* @var $role Model\User\Role */
                    if ($role->isAllowed('lyric_edit')) {
                        return VoterInterface::ACCESS_GRANTED;
                    }
                }
            
                
                break;
            case 'view':
                
                return VoterInterface::ACCESS_GRANTED;
                break;
        }
        return VoterInterface::ACCESS_ABSTAIN;
    }

}
