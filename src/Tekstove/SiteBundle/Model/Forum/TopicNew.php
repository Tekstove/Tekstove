<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tekstove\SiteBundle\Model\Forum;

/**
 * Description of TopicNew
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TopicNew extends Topic
{
    private $postText;
    
    public function getPostText()
    {
        return $this->postText;
    }

    public function setPostText($postText)
    {
        $this->postText = $postText;
    }
}
