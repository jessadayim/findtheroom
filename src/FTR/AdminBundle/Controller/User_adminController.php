<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTR\AdminBundle\Entity\User_admin;

/**
 * User_admin controller.
 *
 * @Route("/user_admin")
 */
class User_adminController extends Controller
{
    /**
     * Lists all User_admin entities.
     *
     * @Route("/", name="user_admin")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTRAdminBundle:User_admin')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a User_admin entity.
     *
     * @Route("/{id}/show", name="user_admin_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTRAdminBundle:User_admin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User_admin entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
