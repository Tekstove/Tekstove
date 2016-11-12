<?php

namespace Tekstove\SiteBundle\Model\User;

/**
 * Description of Pm
 *
 * @author po_taka
 */
class Pm
{
    use \Tekstove\SiteBundle\Helper\ChangeSetable;
    
    private $id;
    private $title;
    private $read;
    private $text;
    private $datetime;
    
    private $userFrom;
    private $userTo;
    
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
        
        if (isset($data['text'])) {
            $this->text = $data['text'];
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
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->changedFields['title'] = 'title';
        $this->title = $title;
    }
        
    public function getRead()
    {
        return $this->read;
    }
    
    public function setRead($read)
    {
        $this->changedFields['read'] = 'read';
        $this->read = (bool) $read;
    }

    public function getText()
    {
        return $this->text;
    }
    
    public function setText($text)
    {
        $this->changedFields['text'] = 'text';
        $this->text = $text;
    }

    public function getUserFrom()
    {
        return $this->userFrom;
    }
    
    public function setUserFrom(User $userFrom)
    {
        $this->userFrom = $userFrom;
    }

    public function getUserTo()
    {
        return $this->userTo;
    }
    
    public function setUserTo(User $userTo)
    {
        $this->changedFields['userTo'] = 'userTo';
        $this->userTo = $userTo;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }
}
