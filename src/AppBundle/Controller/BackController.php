<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends Controller
{

    /**
     * @Route("/admin/", name="back.index")
     */
    public function indexAction()
    {
        return $this->render(':Back:index.html.twig', array(

        ));
    }
}