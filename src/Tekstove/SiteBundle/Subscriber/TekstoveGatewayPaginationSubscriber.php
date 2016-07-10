<?php

namespace Tekstove\SiteBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Component\Pager\Event\ItemsEvent;
use Tekstove\SiteBundle\Model\Gateway\GatewayInterface;

/**
 * Description of TekstoveGatewayPaginationSubscriber
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TekstoveGatewayPaginationSubscriber implements EventSubscriberInterface
{
    public function items(ItemsEvent $event)
    {
        $gateway = $event->target;
        if ($gateway instanceof GatewayInterface) {
            $sortFieldParamName = $event->options['sortFieldParameterName'];
            if (isset($_GET[$sortFieldParamName])) {
                throw new \Exception("Not implemented");
                $direction = strtolower($_GET[$event->options['sortDirectionParameterName']]) === 'asc' ? 'asc' : 'desc';
                $part = $_GET[$sortFieldParamName];

                if (isset($event->options['sortFieldWhitelist'])) {
                    if (!in_array($_GET[$sortFieldParamName], $event->options['sortFieldWhitelist'])) {
                        throw new \UnexpectedValueException("Cannot sort by: [{$_GET[$sortFieldParamName]}] this field is not in whitelist");
                    }
                }
                
                $gateway->orderBy($part, $direction);
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
