<?php

namespace Tekstove\SiteBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Tekstove\SiteBundle\Model\User;
use Tekstove\SiteBundle\Model\Lyric\Lyric;

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
                
                if (!$user instanceof User) {
                    return VoterInterface::ACCESS_DENIED;
                }
                
                /* @var $user Model\User */
                if ($user->getId() === $object->getUserId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                
                $permissionValue = $user->getPermission('lyric_edit');
                if ($permissionValue) {
                    return VoterInterface::ACCESS_GRANTED;
                }

                break;
            case 'view':
                return VoterInterface::ACCESS_GRANTED;
                break;
        }
        return VoterInterface::ACCESS_ABSTAIN;
    }
}
