<?php

namespace Tekstove\TekstoveBundle\Model\User;

use Tekstove\TekstoveBundle\Model\Db\DbInterface;

/**
 * Description of Manager
 *
 * @author potaka
 */
class Manager
{

    /**
     *
     * @var \PDO
     */
    private $db;

    public function __construct(DbInterface $db)
    {
        $this->db = $db->getDb();
    }

    public function findById($id)
    {
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                `users`
            WHERE
                `id` = ?
        ");

        $stm->bindValue(1, $id);
        $stm->execute();
        $data = $stm->fetch();
        
        $user = new \Tekstove\TekstoveBundle\Model\User($data, $this);
        return $user;
        
    }

    public function findByUsername($username)
    {
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                `users`
            WHERE
                `username` = ?
        ");

        $stm->bindValue(1, $username);
        $stm->execute();
        $data = $stm->fetch();

        return $data;
    }

    public function getRoles(\Tekstove\TekstoveBundle\Model\User $user)
    {
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                permission_groups
            INNER JOIN
                permission_group_users
                    ON
                        permission_group_users.groupId = permission_groups.id
                        AND permission_group_users.userId = :userId
        ");
        
        $stm->bindValue('userId', $user->getId());
        
        $stm->execute();
        
        $roles = [];
        $stmPermissions = $this->db->prepare("
            SELECT
                permissions.*
            FROM
                permission_groups
            INNER JOIN
                permission_group_permissions
                    ON
                        groupId = permission_groups.id
            INNER JOIN
                permissions
                    ON
                        permissions.id = permissionId
            WHERE
                permission_groups.id = :groupId
        ");
        
        while ($roleData = $stm->fetch()) {
            $permissions = [];
            $stmPermissions->bindValue('groupId', $roleData['id']);
            $stmPermissions->execute();
            foreach ($stmPermissions->fetchAll() as $permissionData) {
                $permissions[$permissionData['name']] = $permissionData['value'];
            }
            
            $roleData['permissions'] = $permissions;
            $roleObj = new Role($roleData);
            $roles[] = $roleObj;
        }
        
        return $roles;
                
        
    }
    
    public function register($data) 
    {
        if (empty($data['username'])) {
            throw new Exception\Validation('Въведи потребителско име');
        }
        
        if (empty($data['mail'])) {
            throw new Exception\Validation('Въведи електронна поща');
        }
        
        if (empty($data['password'])) {
            throw new Exception\Validation('Въведи парола');
        }
        
        $passwordEncoded = md5($data['password']);
        
        if (false === $this->isMailAvailable($data['mail'])) {
            throw new Exception\Validation('веведената електронна поща вече се ползва');
        }
        
        if (false === $this->isUsernameAvailable($data['username'])) {
            throw new Exception\Validation('веведеното потребителско име вече се ползва');
        }
        
        $stm = $this->db->prepare("
            INSERT INTO
                `users` (`username`, `mail`, `password`)
            VALUES
                (:username, :mail, :password)
        ");
        
        $stm->bindValue('username', $data['username']);
        $stm->bindValue('mail', $data['mail']);
        $stm->bindValue('password', $passwordEncoded);
        $stm->execute();
        $userId = $this->db->lastInsertId();
        return $this->findById($userId);
    }
    
    public function isMailAvailable($mail)
    {
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                users
            WHERE
                mail = :mail
        ");
        
        $stm->bindValue('mail', $mail);
        $stm->execute();
        if ($stm->rowCount()) {
            return false;
        }
        
        return true;
    }
    
    public function isUsernameAvailable($username)
    {
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                users
            WHERE
                username = :username
        ");
        
        $stm->bindValue('username', $username);
        $stm->execute();
        if ($stm->rowCount()) {
            return false;
        }
        
        return true;
    }

}
