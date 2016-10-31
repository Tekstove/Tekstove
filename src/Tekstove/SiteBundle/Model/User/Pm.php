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
    private $read;
    private $text;
    private $datetime;
    
    private $userFrom;
    
    private $changeSet = [];
    
    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        
        if (isset($data['read'])) {
            $this->read = $data['read'];
        }
        
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        
        if (isset($data['userFrom'])) {
            $this->userFrom = new User($data['userFrom']);
        }
        
        if (isset($data['datetime'])) {
            $this->datetime = new \DateTime('@' . $data['datetime']);
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
    
    public function getRead()
    {
        return $this->read;
    }
    
    public function setRead($read)
    {
        $this->changeSet['read'] = 'read';
        $this->read = (bool) $read;
    }

    public function getText()
    {
        return $this->text;
    }
    
    public function getUserFrom()
    {
        return $this->userFrom;
    }
    
    public function getDatetime()
    {
        return $this->datetime;
    }
    
    public function getChangeSet()
    {
        return $this->changeSet;
    }
}
