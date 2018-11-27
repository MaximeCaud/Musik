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


    /**
     * @Route("/admin/media", name="back.media")
     */
    public function mediaAction()
    {
        return $this->render(':Back:media.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/news", name="back.news")
     */
    public function newsAction()
    {
        return $this->render(':Back:news.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/event", name="back.event")
     */
    public function eventAction()
    {
        return $this->render(':Back:event.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/media/{id}", name="back.media.edit")
     */
    public function editmediaAction($id)
    {
        return $this->render(':Back:editmedia.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/news/{id}", name="back.news.edit")
     */
    public function editnewsAction($id)
    {
        return $this->render(':Back:editnews.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/event/{id}", name="back.event.edit")
     */
    public function editeventAction($id)
    {
        return $this->render(':Back:editevent.html.twig', array(

        ));
    }


}