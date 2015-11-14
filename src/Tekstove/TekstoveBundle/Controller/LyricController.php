<?php

namespace Tekstove\TekstoveBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Tekstove\TekstoveBundle\Model\Lyric;
use Tekstove\TekstoveBundle\Form\Type\LyricType;

/**
 * Description of LyricController
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricController extends Controller
{
    /**
     * @Template()
     */
    public function viewAction($id)
    {
        $lyricQuery = $this->get('tekstove.model.lyric.query');
        /* @var $lyricQuery \Tekstove\TekstoveBundle\Model\LyricQuery */
        $lyric = $lyricQuery->findOneById($id);
        
        if (false === $this->get('security.authorization_checker')->isGranted('view', $lyric)) {
            throw new \Exception('Unauthorised access!');
        }
        
        return [
            'lyric' => $lyric,
        ];
    }
    
    /**
     * @Template("TekstoveBundle:Lyric:add.html.twig")
     */
    public function addHtmlAction(Request $request)
    {
        $lyric = new Lyric();
        $form = $this->createCreateForm($lyric);
        $form->handleRequest($request);
        if ($form->isValid()) {
//            var_dump($lyric); die;
            $lyric->save();
            return $this->redirectToRoute('lyricView', ['id' => $lyric->getId()]);
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
    
    /**
     * @Template()
     */
    public function addAction(Request $request)
    {
        $lyric = new Lyric();
        $form = $this->createCreateForm($lyric);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
    
    public function createCreateForm(Lyric $lyric)
    {
        $formType = new LyricType();
        $form = $this->createForm($formType, $lyric);
        $form->add('submit', 'submit');
        
        return $form;
    }
    
    public function addJsonAction(Request $request)
    {
        throw new \Exception('deprecated');
    }
    
    /**
     * @Template()
     */
    public function editAction($id)
    {
        $lyricManager = $this->get('tekstoveLyricManager');
        /* @var $lyricManager \Tekstove\TekstoveBundle\Model\Lyric\Manager */
        
        $lyric = $lyricManager->getById($id);
        /* @var $lyric \Tekstove\TekstoveBundle\Model\Lyric */
        
        $formBuilder = $this->getLyricFormBuilder();
        
        $form = $formBuilder->getForm();
        
        $form->get('title')
                ->setData($lyric->getTitle());
        $form->get('text')
                ->setData($lyric->getText());
        
        return [
            'form' => $form->createView(),
        ];
    }

}
