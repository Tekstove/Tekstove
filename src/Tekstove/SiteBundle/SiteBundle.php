<?php

namespace Tekstove\SiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tekstove\SiteBundle\DependencyInjection\Security\Factory\WsseFactory;

class SiteBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new WsseFactory());
    }
}
