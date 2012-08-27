<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\Ftr_log;

/**
 * Ftr_log controller.
 *
 * @Route("/ftr_log")
 */
class Ftr_logController extends Controller
{
    /**
     * Lists all Ftr_log entities.
     *
     * @Route("/", name="ftr_log")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRAdminBundle:Ftr_log')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Ftr_log entity.
     *
     * @Route("/{id}/show", name="ftr_log_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:Ftr_log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ftr_log entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
