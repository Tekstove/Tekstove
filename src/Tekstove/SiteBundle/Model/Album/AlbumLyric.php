<?php

namespace Tekstove\SiteBundle\Model\Album;

use Tekstove\SiteBundle\Helper\ArrayableInterface;

/**
 * Description of AlbumLyric
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class AlbumLyric implements ArrayableInterface
{
    private $lyric;
    private $name;

    public function __construct(array $data = [])
    {
        if (isset($data['lyric'])) {
            $this->lyric = new \Tekstove\SiteBundle\Model\Lyric\Lyric($data['lyric']);
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
    }

    public function toArray()
    {
        return [
            'lyric' => $this->lyric ? $this->lyric->getId() : null,
            'name' => $this->name ?? null,
        ];
    }

    public function getLyric()
    {
        return $this->lyric;
    }

    public function setLyric($lyric)
    {
        if (is_numeric($lyric)) {
            $lyric = new \Tekstove\SiteBundle\Model\Lyric\Lyric(
                [
                    'id' => (int)$lyric,
                ]
            );
        }

        if (!$lyric instanceof \Tekstove\SiteBundle\Model\Lyric\Lyric) {
            throw new \Exception('Expected instance of lyric');
        }

        $this->lyric = $lyric;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLyricName()
    {
        if ($this->isLyric()) {
            return $this->getLyric()->getTitle();
        }

        return $this->getName();
    }

    public function isLyric()
    {
        return $this->lyric !== null;
    }
}
