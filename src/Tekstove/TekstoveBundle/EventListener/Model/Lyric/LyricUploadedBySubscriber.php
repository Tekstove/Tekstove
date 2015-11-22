<?php

namespace Tekstove\TekstoveBundle\EventListener\Model\Lyric;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

use Tekstove\TekstoveBundle\Model\Lyric;

/**
 * Description of LyricUploadedBySubscriber
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricUploadedBySubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    /**
     *
     * @var TokenStorage 
     */
    private $securityContext;
    /**
     *
     * @var AuthorizationCheckerhecker 
     */
    private $authchecker;
    
    public function __construct(TokenStorage $securityContext, AuthorizationChecker $authChecker)
    {
        $this->securityContext = $securityContext;
        $this->authchecker = $authChecker;
    }

    
    public static function getSubscribedEvents()
    {
        return array(
            'tekstove.lyric.save' => 'saveEvent',
        );
    }
    
    public function saveEvent(\Tekstove\TekstoveBundle\Model\EventDispatcher\Event $event)
    {
        $lyric = $event->getSubject();
        $this->updateUpdateuserId($lyric);
    
    }

    public function updateUpdateuserId(Lyric $lyric)
    {

        // update only on new lyric
        if ($lyric->getId()) {
            return false;
        }
        
        $isAuth = $this->authchecker->isGranted('IS_AUTHENTICATED_REMEMBERED');
        if (!$isAuth) {
            return false;
        }
        
        $user = $this->securityContext->getToken()->getUser();
        $lyric->setUser($user);
    }
}
