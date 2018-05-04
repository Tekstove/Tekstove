<?php

use PHPUnit\Framework\TestCase;
use Tekstove\SiteBundle\Event\User\TermsForceListener;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Tekstove\SiteBundle\Model\User\Provider\User;

class TermsForceListenerTest extends TestCase
{
    private function getEventMock($pathInfo, $isMasterRequest = true)
    {
        $requestMockBuilder = $this->getMockBuilder(\Symfony\Component\HttpFoundation\Request::class);
        $requestMockBuilder->disableOriginalConstructor();
        $requestMockBuilder->setMethods(['getPathInfo']);
        $request = $requestMockBuilder->getMock();
        $request->expects($this->any())->method('getPathInfo')->willReturn($pathInfo);


        $eventMockBuilder = $this->getMockBuilder(GetResponseEvent::class);
        $eventMockBuilder->setMethods(['isMasterRequest', 'getRequest']);
        $eventMockBuilder->disableOriginalConstructor();
        $event = $eventMockBuilder->getMock();
        $event->expects($this->any())->method('isMasterRequest')->willReturn($isMasterRequest);
        $event->expects($this->any())->method('getRequest')->willReturn($request);

        return $event;
    }

    private function getTokenStorage($user)
    {
        $tokenMockBuilder = $this->getMockBuilder(AbstractToken::class);
        $tokenMockBuilder->disableOriginalConstructor();
        $tokenMockBuilder->setMethods(['getUser']);
        $tokenMock = $tokenMockBuilder->getMockForAbstractClass();

        $tokenStorageMockBuilder = $this->getMockBuilder(TokenStorage::class);
        $tokenStorageMockBuilder->disableOriginalConstructor();
        $tokenStorageMockBuilder->setMethods(['getToken']);
        $tokenStorage = $tokenStorageMockBuilder->getMock();
        $tokenStorage->expects($this->any())->method('getToken')->willReturn($tokenMock);

        $tokenMock->expects($this->any())->method('getUser')->willReturn($user);

        return $tokenStorage;
    }

    public function testRedirect()
    {
        $userMockBuilder = $this->getMockBuilder(User::class);
        $userMockBuilder->disableOriginalConstructor();
        $user = $userMockBuilder->getMock();


        $listener = new TermsForceListener(
            $this->getTokenStorage(
                $user
            )
        );

        $event = $this->getEventMock(
            '/search'
        );
        $listener->onKernelRequest($event);
        $this->assertInstanceOf(RedirectResponse::class, $event->getResponse());
        $this->assertTrue($event->isPropagationStopped());
    }

    public function testRedirectNotMasterRequest()
    {
        $userMockBuilder = $this->getMockBuilder(User::class);
        $userMockBuilder->disableOriginalConstructor();
        $user = $userMockBuilder->getMock();


        $listener = new TermsForceListener(
            $this->getTokenStorage(
                $user
            )
        );

        $event = $this->getEventMock(
            '/search',
            false
        );
        $listener->onKernelRequest($event);
        $this->assertFalse($event->hasResponse());
        $this->assertFalse($event->isPropagationStopped());
    }

    public function testNoUser()
    {
        $listener = new TermsForceListener(
            $this->getTokenStorage(
                null
            )
        );

        $event = $this->getEventMock(
            '/search',
            false
        );
        $listener->onKernelRequest($event);
        $this->assertFalse($event->hasResponse());
        $this->assertFalse($event->isPropagationStopped());
    }

    public function testWhenUserIsOnTosPage()
    {
        $userMockBuilder = $this->getMockBuilder(User::class);
        $userMockBuilder->disableOriginalConstructor();
        $user = $userMockBuilder->getMock();


        $listener = new TermsForceListener(
            $this->getTokenStorage(
                $user
            )
        );

        $event = $this->getEventMock(
            '/user/force-terms/123456'
        );
        $listener->onKernelRequest($event);
        $this->assertFalse($event->hasResponse());
        $this->assertFalse($event->isPropagationStopped());
    }
}
