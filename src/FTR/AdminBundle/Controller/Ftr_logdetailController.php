<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\Ftr_logdetail;

/**
 * Ftr_logdetail controller.
 *
 * @Route("/ftr_logdetail")
 */
class Ftr_logdetailController extends Controller
{
    /**
     * Lists all Ftr_logdetail entities.
     *
     * @Route("/", name="ftr_logdetail")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRAdminBundle:Ftr_logdetail')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Ftr_logdetail entity.
     *
     * @Route("/{id}/show", name="ftr_logdetail_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Ftr_logdetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ftr_logdetail entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}