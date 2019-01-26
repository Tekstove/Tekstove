<?php

namespace Tekstove\SiteBundle\Model\Publisher;


class Publisher
{
    private $id;
    private $name;

    public function __construct($data = [])
    {
        $fields = [
            'id',
            'name',
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
}
