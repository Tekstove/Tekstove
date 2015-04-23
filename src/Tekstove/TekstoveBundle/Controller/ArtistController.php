<?php

namespace Tekstove\TekstoveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArtistController extends Controller
{

    /**
     * @Template()
     */
    public function browseAction($id)
    {
        $lyricManager = $this->get('tekstoveLyricManager');
        $lyrics = $lyricManager->getByArtist($id);
        return [
            'lyrics' => $lyrics,
        ];
    }
    
    /**
     * 
     * @Template
     */
    public function listAction($letter)
    {
        $artistManager = $this->get('tekstoveArtistManager');
        $artists = $artistManager->findByStartWith($letter);
        
        
        return [
            'artists' => $artists,
        ];
        
    }

}
