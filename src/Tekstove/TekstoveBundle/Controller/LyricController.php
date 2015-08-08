<?php

namespace Tekstove\TekstoveBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of LyricController
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricController extends Controller
{
    
    protected function getLyricFormBuilder()
    {
        $formBuilderOptions = [
            'attr' => [
                'id' => 'lyric_form',
            ]
        ];
        $formBuilder = $this->createFormBuilder(null, $formBuilderOptions);
        $formBuilder->add('title','text');
        $formBuilder->add('text', 'textarea');
        $formBuilder->add('text_bg', 'textarea', ['required' => false]);
        $formBuilder->add('youtube', 'text', ['required' => false]);
        $formBuilder->add('vbox7', 'text', ['required' => false]);
        $formBuilder->add('metacafe', 'text', ['required' => false]);
        $formBuilder->add('submit', 'button');
        return $formBuilder;
    }

    /**
     * @Template()
     */
    public function viewAction($id)
    {
        $repo = \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create();
        
        $lyric = $repo->findOneById($id);
        
        if (false === $this->get('security.authorization_checker')->isGranted('view', $lyric)) {
            throw new \Exception('Unauthorised access!');
        }
        
        return [
            'lyric' => $lyric,
        ];
    }
    
    /**
     * @Template()
     */
    public function addAction()
    {
        $formBuilder = $this->getLyricFormBuilder();
        $form = $formBuilder->getForm();
        
        $form = $this->createForm(new \Tekstove\TekstoveBundle\Form\Type\LyricType());
        
        return [
            'form' => $form->createView(),
        ];
    }
    
    public function addJsonAction(Request $request)
    {
        $formBuilder = $this->getLyricFormBuilder();
        $form = $formBuilder->getForm();
        /* @var $form \Symfony\Component\Form\Form */
        $lyricManager = $this->get('tekstoveLyricManager');
        /* @var $lyricManager \Tekstove\TekstoveBundle\Model\Lyric\Manager */
        
        $form->handleRequest($request);
        
        if (false == $form->isValid()) {
        
            $error = $form->getErrors();
            
            $return = [
                'error' => $error->current()->getMessage()
            ];
            return new JsonResponse($return, Response::HTTP_BAD_REQUEST);
        }
        
        try {
            $lyric = new \Tekstove\TekstoveBundle\Model\Lyric(null, $lyricManager);
            $lyric->setText($form->get('text')->getData());
            $lyric->setTitle($form->get('title')->getData());
            
                $updatedLyric = $lyricManager->save($lyric);
            
                $returnData = [
                'valid' => true,
                'lyric' => [
                    'id' => $updatedLyric->getId(),
                ]
            ];
            
        } catch (\Tekstove\TekstoveBundle\Model\Exception\ValidationException $ex) {
            $returnData = [
                    'valid' => false,
                    'error' => $ex->getMessage(),
                    'field' => $ex->getField(),
                ];
                
                return new JsonResponse($returnData, Response::HTTP_BAD_REQUEST);
        } catch (\Exception $ex) {
            if ($ex instanceof \Tekstove\TekstoveBundle\Model\Exception\HumanReadableInterface) {
                $returnData = [
                    'valid' => false,
                    'error' => $ex->getMessage(),
                ];
                
                return new JsonResponse($returnData, Response::HTTP_BAD_REQUEST);
                
            } else {
                throw $ex;
            }
        }
        
        
        return new JsonResponse($returnData);
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
