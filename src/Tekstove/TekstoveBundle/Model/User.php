<?php

namespace Tekstove\TekstoveBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class User extends Entity implements \Symfony\Component\Security\Core\User\AdvancedUserInterface, \Serializable
{

    private $manager;
    private $id;
    private $username;
    private $password;
    private $about;
    private $avatar;
    private $className;
    private $salt = '';
    private $roles = null;

    public function __construct($data, User\Manager $manager) {
        $this->manager = $manager;

        if (is_array($data)) {
            $this->id = (int) $data['id'];
            $this->username = $data['username'];
            $this->password = $data['password'];
            $this->about = $data['about'];
            $this->avatar = $data['avatar'];
            $this->className = $data['classCustomName'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getRoles() {
        if ($this->roles === null) {
            $this->roles = $this->manager->getRoles($this);
        }

        return $this->roles;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function getAbout() {
        return $this->about;
    }
    
    public function getAvatar() {
        return $this->avatar;
    }
    
    public function getClassName() {
        if ($this->className) {
            $return = $this->className;
        } else {
            $return = 'потребител';
        }
        
        return $return;
    }

    public function eraseCredentials() {
        
    }

    public function isEqualTo(UserInterface $user) {
        if (!$user instanceof Tekstove\TekstoveBundle\Model\User) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    public function __sleep() {
        $this->getRoles();
        $this->manager = null;

        return ['id', 'username', 'password', 'roles'];
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return true;
    }

    public function serialize() {
        /**
         * Due to bug in php 5.4 we need to serialize manually
         */
        $data = [];
        foreach ($this->__sleep() as $property) {
            $data[$property] = $this->{$property};
        }

        return json_encode($data);
    }

    public function unserialize($serialized) {
        $array = json_decode($serialized);
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }

}
