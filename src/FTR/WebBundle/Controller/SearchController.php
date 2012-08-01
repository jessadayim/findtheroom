<?php

namespace FTR\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchController extends Controller
{
    
    public function searchAction()
    {
        return $this->render('FTRWebBundle:Search:search.html.twig', array());
    }
}
