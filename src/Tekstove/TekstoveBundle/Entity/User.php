<?php

namespace Tekstove\TekstoveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity()
 */
class User implements AdvancedUserInterface, \Serializable
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column()
     */
    private $username;
    /**
     * @ORM\Column()
     */
    private $password;
    
    /**
     * @ORM\Column()
     */
    private $mail;
    private $about;
    private $avatar;
    private $className;
    private $salt = '';
    private $roles = null;

    public function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getRoles() {
        return [];
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $passwordEncoded = md5($password);
        $this->password = $passwordEncoded;
    }
    
    public function getMail() {
        return $this->mail;
    }
    
    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
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
        if (!$user instanceof User) {
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
