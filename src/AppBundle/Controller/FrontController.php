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
        $manager = $this->getDoctrine()->getManager();

        $news = $manager->getRepository('AppBundle:News')
            ->findBy(array(), array('createdAt' => 'asc'), 6 , 0);
        $media = $manager->getRepository('AppBundle:Media')
            ->findBy(array(), array('publishedAt' => 'asc'), 4 ,0);
        return $this->render(':Front:index.html.twig', array(
            'listnews'  =>  $news,
            'listmedia' =>  $media,

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

    /**
     * @Route("/news", name="front.news")
     */
    public function newsAction()
    {
        return $this->render(':Front:news.html.twig',array(

        ));
    }
}
