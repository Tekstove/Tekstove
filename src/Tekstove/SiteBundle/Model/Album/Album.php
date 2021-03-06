<?php

namespace Tekstove\SiteBundle\Model\Album;

use Tekstove\SiteBundle\Model\Artist\Artist;

/**
 * Album
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Album
{
    use \Tekstove\SiteBundle\Helper\ChangeSetable;

    private $id;
    private $name;
    private $image;
    private $year;

    private $acl;

    private $sendByUser;
    /**
     * AlbumLyric[]
     */
    private $lyrics;
    private $artists;

    public function __construct(array $data = [])
    {
        $fields = [
            'id',
            'name',
            'image',
            'year',

            'acl',
        ];

        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
        }

        if (isset($data['user'])) {
            $this->sendByUser = new \Tekstove\SiteBundle\Model\User\User($data['user']);
        }

        if (isset($data['lyrics'])) {
            $this->lyrics = [];
            foreach ($data['lyrics'] as $lyricData) {
                $this->lyrics[] = new AlbumLyric($lyricData);
            }
        }

        if (isset($data['artists'])) {
            $this->artists = [];
            foreach ($data['artists'] as $artistData) {
                $this->artists[] = new \Tekstove\SiteBundle\Model\Artist\Artist($artistData);
            }
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

    public function setName(string $name)
    {
        $this->changedFields['name'] = 'name';
        $this->name = $name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->changedFields['image'] = 'image';
        $this->image = $image;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->changedFields['year'] = 'year';
        $this->year = $year;
    }

    public function getSendByUser()
    {
        return $this->sendByUser;
    }

    public function getLyrics()
    {
        return $this->lyrics;
    }

    public function addLyric($lyric)
    {
        $this->changedFields['lyrics'] = 'lyrics';
        $this->lyrics[] = $lyric;
    }

    public function removeLyric(AlbumLyric $lyric)
    {
        $this->changedFields['lyrics'] = 'lyrics';
        foreach ($this->lyrics as $key => $existingLyric) {
            if ($existingLyric->getName() == $lyric->getName()
                && (
                    (
                        $existingLyric->getLyric() && $lyric->getLyric()
                        && $existingLyric->getLyric()->getId() == $lyric->getLyric()->getId()
                    )
                    || (!$existingLyric->getLyric() && !$lyric->getLyric())
                )
            ) {
                unset($this->lyrics[$key]);
                return;
            }
        }
    }

    /**
     * The problem is that change in album-lyric do not trigger change in album.
     * This method is called when there is change in album-lyric.....ugly
     */
    public function markLyricsAsChanged()
    {
        $this->changedFields['lyrics'] = 'lyrics';
    }

    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * @param Artist $artist
     */
    public function addArtist(Artist $artist)
    {
        $this->changedFields['artists'] = 'artists';
        $this->artists[] = $artist;
    }

    public function removeArtist(Artist $artistToRemove)
    {
        $this->changedFields['artists'] = 'artists';
        foreach ($this->artists as $artistKey => $existingArtist) {
            if ($existingArtist->getId() == $artistToRemove->getId()) {
                unset($this->artists[$artistKey]);
                return true;
            }
        }
    }

    /**
     * @param string $property
     * @return int|null
     */
    public function getAcl($property)
    {
        if (isset($this->acl[$property])) {
            return $this->acl[$property];
        }

        return null;
    }
}
