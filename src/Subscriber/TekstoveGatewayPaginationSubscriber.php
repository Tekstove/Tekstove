<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Knp\Component\Pager\Event\ItemsEvent;
use Tekstove\SiteBundle\Model\Gateway\GatewayInterface;

/**
 * Paginate gateway result
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TekstoveGatewayPaginationSubscriber implements EventSubscriberInterface
{
    /** @var RequestStack */
    private $requestStack;
    
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function items(ItemsEvent $event)
    {
        $gateway = $event->target;
        if ($gateway instanceof GatewayInterface) {
            $request = $this->requestStack->getCurrentRequest();
            $sortFieldParamName = $event->options['sortFieldParameterName'];
            if ($request->get($sortFieldParamName)) {
                throw new \Exception("Not implemented");
            }
            
            $limit = $event->getLimit();
            $offset = $event->getOffset();
            
            $gateway->setLimit($limit);
            $gateway->setOffset($offset);
            $itemsData = $gateway->find();
            $items = $itemsData['items'];
            $event->items = $items;
            
            $event->count = $itemsData['pagination']['totalItemCount'];
            $event->stopPropagation();
        }
    }
    
    public static function getSubscribedEvents()
    {
        return[
            'knp_pager.items' => [
                'items',
                /* increased priority to override any internal */
                1,
            ],
        ];
    }
}
