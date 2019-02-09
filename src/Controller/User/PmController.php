<?php

namespace App\Controller\User;

use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\PmGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\User\Pm;
use Tekstove\SiteBundle\Form\Type\User\PmType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Tekstove\SiteBundle\Model\User\User;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

/**
 * @author potaka
 */
class PmController extends AbstractController
{
    /**
     * @Template()
     */
    public function listAction(Request $request, PmGateway $pmGateway, PaginatorInterface $paginator)
    {
        $pmGateway->addFilter('userTo', $this->getUser()->getId());
        
        $pmGateway->setGroups(['List']);
        $pagination = $paginator->paginate(
            $pmGateway,
            $request->query->getInt('page', 1),
            15
        );
        
        return [
            'pmPagination' => $pagination,
        ];
    }

    /**
     *
     * @param int $id
     *
     * @Template()
     */
    public function viewAction($id, LoggerInterface $logger, PmGateway $pmGateway, PmGateway $pmGatewayMarkread, PmGateway $pmHistoryGateway)
    {
        $pmGateway->setGroups([PmGateway::GROUP_DETAILS]);
        $pmData = $pmGateway->get($id);
        $pm = $pmData['item'];
        /* @var $pm \Tekstove\SiteBundle\Model\User\Pm */

        // mark pm as read
        try {
            if (!$pm->getRead()) {
                $pm->setRead(true);
                $pmGatewayMarkread->save($pm);
            }
        } catch (RequestException $e) {
            $logger->critical('Can\'t mark pm as read', ['exception' => $e]);
        }

        $pmHistoryGateway->setGroups([PmGateway::GROUP_DETAILS]);

        $compositeFilter = new \Tekstove\SiteBundle\Model\Gateway\Tekstove\CompositeFilter(PmGateway::FILER_OR);

        $compositeFilterFrom = new \Tekstove\SiteBundle\Model\Gateway\Tekstove\CompositeFilter(PmGateway::FILER_AND);
        $compositeFilterFrom->addFilter('userTo', $this->getUser()->getId());
        $compositeFilterFrom->addFilter('userFrom', $pm->getUserFrom()->getId());

        $compositeFilterTo = new \Tekstove\SiteBundle\Model\Gateway\Tekstove\CompositeFilter(PmGateway::FILER_AND);
        $compositeFilterTo->addFilter('userTo', $pm->getUserFrom()->getId());
        $compositeFilterTo->addFilter('userFrom', $this->getUser()->getId());

        $compositeFilter->addCompositeFilter($compositeFilterFrom);
        $compositeFilter->addCompositeFilter($compositeFilterTo);

        $pmHistoryGateway->addCompositeFilter($compositeFilter);
        // I'm not sure if there should be filter to exclude current PM
        $pmHistoryGateway->addOrder('id', PmGateway::ORDER_DESC);
        $pmHistoryData = $pmHistoryGateway->find();
        
        return [
            'pm' => $pm,
            'pmHistory' => $pmHistoryData['items'],
        ];
    }
    
    /**
     * @Template()
     */
    public function addAction(Request $request, $toUserId, $title, PmGateway $pmGateway)
    {
        // @TODO user must be logged.
        // Anyway, api will not validate request....
        
        $pm = new Pm();
        $pm->setTitle($title);
        $pm->setUserTo(new User(['id' => (int) $toUserId]));
        
        $form = $this->createCreateForm($pm);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $pmGateway->save($pm);
                return $this->redirectToRoute('userPmList');
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
    
    private function createCreateForm(Pm $pm)
    {
        $form = $this->createForm(
            PmType::class,
            $pm
        );
        $form->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Send',
                'attr' => [
                    'class' => 'btn-success',
                ],
            ]
        );
        
        return $form;
    }
}
