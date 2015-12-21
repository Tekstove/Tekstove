<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Tekstove\SiteBundle\Model\Lyric;
use Tekstove\SiteBundle\Form\Type\LyricType;
use Tekstove\SiteBundle\Model\LyricQuery;

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
        $lyricQuery = new LyricQuery();
        $lyric = $lyricQuery->findOneById($id);
        
        if (false === $this->get('security.authorization_checker')->isGranted('view', $lyric)) {
            throw new \Exception('Unauthorised access!');
        }
        
        return [
            'lyric' => $lyric,
        ];
    }
    
    /**
     * @Template("SiteBundle:Lyric:add.html.twig")
     */
    public function addHtmlAction(Request $request)
    {
        $lyric = new Lyric();
        $form = $this->createCreateForm($lyric);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $repo = $this->get('tekstove.lyric.repository');
            $repo->save($lyric);
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
    
    public function createEditForm(Lyric $lyric)
    {
        $formType = new LyricType();
        $form = $this->createForm($formType, $lyric);
        $form->add('submit', 'submit');
        
        return $form;
    }
    
    /**
     * @Template()
     */
    public function editAction($id, Request $request)
    {
        $lyricQuery = new LyricQuery();
        
        $lyric = $lyricQuery->findOneById($id);
        if (!$lyric) {
            throw new NotFoundHttpException('Lyric not found');
        }
        
        if (!$this->isGranted('edit', $lyric)) {
            throw new AccessDeniedHttpException();
        }
        
        $form = $this->createEditForm($lyric);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $repo = $this->get('tekstove.lyric.repository');
            $repo->save($lyric);
            return $this->redirectToRoute('lyricView', ['id' => $lyric->getId()]);
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
}
