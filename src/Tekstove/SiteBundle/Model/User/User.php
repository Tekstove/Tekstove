<?php

namespace Tekstove\SiteBundle\Model\User;

use \Tekstove\SiteBundle\Helper\ArrayableInterface;

/**
 * User
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class User implements ArrayableInterface
{
    private $id;
    private $username;
    private $password;
    private $mail;
    private $apiKey;
    private $avatar;
    private $about;
    
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
        ];
        
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
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
    
    public function getAbout()
    {
        return $this->about;
    }
    
    public function toArray()
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
