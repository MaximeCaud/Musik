<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends Controller
{
    /**
     * @Route("/", name="front.index")
     */
    public function indexAction()
    {
        return $this->render(':Front:index.html.twig', array(

        ));
    }

    /**
     * @Route("/about", name="front.about")
     */
    public function aboutAction()
    {
        return $this->render(':Front:about.html.twig', array(

        ));
    }

    /**
     * @Route("/contact", name="front.contact")
     */
    public function contactAction()
    {
        return $this->render(':Front:contact.html.twig', array(

        ));
    }

    /**
     * @Route("/event", name="front.event")
     */
    public function eventAction()
    {
        return $this->render(':Front:event.html.twig', array(

        ));
    }

    /**
     * @Route("/media", name="front.media")
     */
    public function mediaAction()
    {
        return $this->render(':Front:media.html.twig',array(

        ));
    }
}
