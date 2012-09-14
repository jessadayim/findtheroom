<?php

namespace FTR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Manage_resource controller.
 *
 */
class Manage_resourceController extends Controller
{
    public function indexAction()
    {
        return $this->render('FTRAdminBundle:Manage_resource:index.html.twig', array(
        ));
    }

    private function getDataArray($sql){
        $conn= $this->get('database_connection');
        if(!$conn){ die("MySQL Connection error");}        
        try{
            return $conn->fetchAll($sql);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return array();
    }
}
