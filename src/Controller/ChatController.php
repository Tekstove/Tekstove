<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ChatController extends AbstractController
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return [
            'apiUrl' => $this->getParameter('tekstove.api_url'),
        ];
    }
}
