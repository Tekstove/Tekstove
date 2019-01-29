<?php

namespace Tekstove\SiteBundle\Model\Publisher;

class Publisher
{
    private $id;
    private $name;
    private $facebookPageId;

    public function __construct($data = [])
    {
        $fields = [
            'id',
            'name',
            'facebookPageId',
        ];

        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
        }
    }

    /**
     * @return int|null
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
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

}
