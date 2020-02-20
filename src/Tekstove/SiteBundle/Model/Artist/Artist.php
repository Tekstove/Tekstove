<?php

namespace Tekstove\SiteBundle\Model\Artist;

use Tekstove\SiteBundle\Model\Artist\Exception\ArtistException as Exception;

/**
 * Description of Artist
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Artist
{
    use \Tekstove\SiteBundle\Helper\ChangeSetable;

    private $name;
    private $id;
    private $about;
    private $aboutHtml;
    private $facebookPageId;
    
    private $acl;

    public function __construct($data = [])
    {
        $fields = [
            'id',
            'name',
            'about',
            'aboutHtml',
            'acl',
            'facebookPageId',
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
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->changedFields['name'] = 'name';
        $this->name = $name;
    }
    
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return string|null
     */
    public function getAboutHtml(): ?string
    {
        return $this->aboutHtml;
    }

    public function setAbout($about)
    {
        $this->changedFields['about'] = 'about';
        $this->about = $about;
    }

    /**
     * @return string|null
     */
    public function getFacebookPageId(): ?string
    {
        return $this->facebookPageId;
    }

    /**
     * @param mixed $facebookPageId
     */
    public function setFacebookPageId(string $facebookPageId = null)
    {
        $this->facebookPageId = $facebookPageId;
    }

    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl(array $acl)
    {
        $this->acl = $acl;
    }

    public function isEditAllowed()
    {
        if (empty($this->acl)) {
            return false;
        }

        return true;
    }
}
