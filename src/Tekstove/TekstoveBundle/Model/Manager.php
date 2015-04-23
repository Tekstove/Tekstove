<?php

namespace Tekstove\TekstoveBundle\Model;

/**
 * Description of Manager
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
abstract class Manager
{

    /**
     *
     * @var \PDO
     */
    protected $db;
    protected $dbManager;
    protected $acl;
    protected $eventDispatcher;
    
    private $artistManager;
    private $userManager;
    private $languageManager;

    public function __construct(\Tekstove\TekstoveBundle\Model\Db\DbInterface $db) {
        $this->dbManager = $db;
        $this->db = $db->getDb();
    }

    public function getDbManager() {
        return $this->dbManager;
    }
    
    public function setUserManager(\Tekstove\TekstoveBundle\Model\User\Manager $m) {
        $this->userManager = $m;
    }
    
    public function setLanguageManager(\Tekstove\TekstoveBundle\Model\Lyric\Language\Manager $m) {
        $this->languageManager = $m;
    }
    
    /**
     * 
     * @return User\Manager
     * @throws \Exception
     */
    public function getUserNamanger() {
        if ($this->userManager === null) {
            // @TODO throw specific excetpion
            throw new \Exception('manager not set');
        }
        
        return $this->userManager;
    }
    
    public function setArtistManager(\Tekstove\TekstoveBundle\Model\Artist\Manager $m) {
        $this->artistManager = $m;
    }
    
    protected function getArtistManager() {
        if ($this->artistManager === null) {
            // @TODO throw specific excetpion
            throw new \Exception('manager not set');
        }
        
        return $this->artistManager;
    }
    
    /**
     * 
     * @return Lyric\Language\Manager
     * @throws \Exception
     */
    protected function getLanguageManager() {
        if ($this->languageManager === null) {
            // @TODO throw specific excetpion
            throw new \Exception('manager not set');
        }
        
        return $this->languageManager;
    }

    public function getAcl() {
        return $this->acl;
    }

    function setAcl($acl) {
        $this->acl = $acl;
    }

    /**
     * 
     * @param string $query
     * @param array $params
     * @return string
     */
    public function bindCustom($query, array $params) {
        
        $simpleParams = [
            'orderType',
            'order',
        ];
        
        foreach ($simpleParams as $param) {
            if (isset($params[$param])) {
                if (!preg_match('/[a-zA-Z]+/i', $params[$param])) {
                    // @TODO throw specific exception
                    throw new \Exception('Bad param');
                }

                $query = preg_replace('/:' . $param .'/i', $params[$param], $query);
            }
        }
        
        return $query;
    }
    
    public function setEventDispatcher(\Symfony\Component\EventDispatcher\EventDispatcherInterface $ed) {
        $this->eventDispatcher = $ed;
    }
    
    /**
     * 
     * @return \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    public function getEventDispatcher() {
        if (null === $this->eventDispatcher) {
            throw new \Exception('ED not set');
        }
        return $this->eventDispatcher;
    }
    
}
