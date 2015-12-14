<?php

namespace Tekstove\TekstoveBundle\Model\User;

class Role implements \Symfony\Component\Security\Core\Role\RoleInterface
{

    protected $name;
    protected $image;
    private $permissions = null;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->image = $data['image'];
        if (isset($data['permissions'])) {
            $this->permissions = $data['permissions'];
        }
    }

    public function getRole()
    {
        return $this->getName();
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }

    
    public function getPermissions()
    {
        if ($this->permissions === null) {
            throw new \Exception('not implemented');
        }

        return $this->permissions;
    }

    /**
     *
     * @param string $permission
     * @return boolean|int|string
     */
    public function isAllowed($permission)
    {
        $permissions = $this->getPermissions();
        if (array_key_exists($permission, $permissions)) {
            return $permissions[$permission];
        }

        return false;
    }
}
