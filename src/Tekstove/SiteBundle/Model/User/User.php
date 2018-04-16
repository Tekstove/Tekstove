<?php

namespace Tekstove\SiteBundle\Model\User;

use \Tekstove\SiteBundle\Helper\ArrayableInterface;
use Tekstove\SiteBundle\Model\User\Acl\Group;

/**
 * User
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class User implements ArrayableInterface
{
    use \Tekstove\SiteBundle\Helper\ChangeSetable;

    private $id;
    private $username;
    private $password;
    private $mail;
    private $apiKey;
    private $avatar;
    private $about;
    private $termsAccepted;
    
    
    private $groups;
    private $editableFields;
    
    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $fields = [
            'id',
            'username',
            'password',
            'mail',
            'apiKey',
            'avatar',
            'about',
            'termsAccepted',
        ];
        
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
        }
        
        if (isset($data['permissionGroups'])) {
            $this->groups = [];
            foreach ($data['permissionGroups'] as $groupData) {
                $this->groups[] = new Group($groupData);
            }
        }

        if (isset($data['_editableFields'])) {
            $this->editableFields = $data['_editableFields'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getMail()
    {
        return $this->mail;
    }
        
    public function getApiKey()
    {
        return $this->apiKey;
    }
    
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->changedFields['avatar'] = 'avatar';
        $this->avatar = $avatar;
    }

    public function getAbout()
    {
        return $this->about;
    }
    
    public function setAbout($about)
    {
        $this->changedFields['about'] = 'about';
        $this->about = $about;
    }

    /**
     * @return bool|null
     */
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($tosAccpeted)
    {
        $this->termsAccepted = (bool)$tosAccpeted;
    }

    public function getGroups()
    {
        if ($this->groups === null) {
            throw new \RuntimeException("Groups not set");
        }
        return $this->groups;
    }

    public function getEditableFields()
    {
        if ($this->editableFields === null) {
            throw new \RuntimeException("Editable fields not set");
        }
        return $this->editableFields;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
