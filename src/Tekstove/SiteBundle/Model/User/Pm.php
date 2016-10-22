<?php

namespace Tekstove\SiteBundle\Model\User;

/**
 * Description of Pm
 *
 * @author potaka
 */
class Pm
{
    private $id;
    private $title;
    private $text;
    
    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }
}
