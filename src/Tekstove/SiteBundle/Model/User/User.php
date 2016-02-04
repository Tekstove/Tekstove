<?php

namespace Tekstove\SiteBundle\Model\User;

/**
 * Description of User
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class User
{
    private $id;
    private $username;
    private $password;
    private $avatar;
    private $about;
    
    public function __construct($data = [])
    {
        $fields = [
            'id',
            'username',
            'password',
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
    
    public function getAvatar()
    {
        return $this->avatar;
    }
    
    public function getAbout()
    {
        return $this->about;
    }
}
