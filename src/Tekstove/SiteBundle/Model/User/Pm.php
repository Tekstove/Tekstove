<?php

namespace Tekstove\SiteBundle\Model\User;

/**
 * Description of Pm
 *
 * @author potaka
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
        $this->changedFields['userTo'] = 'userTo';
        return $this->userTo;
    }
    
    public function setUserTo(User $userTo)
    {
        $this->userTo = $userTo;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }
    
    /**
     * @TODO move to trait. There is difference. Clear it!
     * @return array
     */
    public function getChangeSet()
    {
        $return = [];
        foreach ($this->getChangedFields() as $field) {
            $getter = 'get' . $field;
            $value = $this->{$getter}();
            if (is_array($value)) {
                $return[$field] = [];
                foreach ($value as $nestedSet) {
                    $return[$field][] = $nestedSet->getId();
                }
            } elseif (is_object($value)) {
                $return[$field] = $value->toArray();
            } else {
                $return[$field] = $value;
            }
        }
        
        return $return;
    }
}
