<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends Controller
{

    /**
     * @Route("/admin/", name="back.index")
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $lastMedia = $manager->getRepository('AppBundle:Media')
            ->findBy(array(), array('publishedAt' => 'ASC'), 10, 0);
        $lastNews = $manager->getRepository('AppBundle:News')
            ->findBy(array(), array('createdAt' => 'ASC'), 10 , 0);
        $lastEvent = $manager->getRepository('AppBundle:Event')
            ->findBy(array(), array('createdAt' => 'ASC'), 10 , 0);

        return $this->render(':Back/pages:index.html.twig', array(
            'lastMedia'     =>  $lastMedia,
            'lastNews'      =>  $lastNews,
            'lastEvent'     =>  $lastEvent
        ));
    }


    /**
     * @Route("/admin/media", name="back.media")
     */
    public function mediaAction(Request $request)
    {
        $manager    = $this->get('doctrine.orm.entity_manager');
        $dql        = "SELECT a FROM AppBundle:Media a";
        $query      = $manager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination  = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render(':Back/pages:media.html.twig', array(
            'pagination'    => $pagination
        ));
    }

    /**
     * @Route("/admin/news", name="back.news")
     */
    public function newsAction(Request $request)
    {
        $manager    = $this->get('doctrine.orm.entity_manager');
        $dql        = "SELECT a FROM AppBundle:News a";
        $query      = $manager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination  = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render(':Back/pages:news.html.twig', array(
            'pagination'    => $pagination
        ));
    }

    /**
     * @Route("/admin/event", name="back.event")
     */
    public function eventAction(Request $request)
    {
        $manager    = $this->get('doctrine.orm.entity_manager');
        $dql        = "SELECT a FROM AppBundle:Event a";
        $query      = $manager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination  = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render(':Back/pages:event.html.twig', array(
            'pagination'    => $pagination
        ));
    }

    /**
     * @Route("/admin/media/{id}", name="back.media.edit")
     */
    public function editmediaAction($id)
    {
        return $this->render(':Back/pages:editmedia.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/news/{id}", name="back.news.edit")
     */
    public function editnewsAction($id)
    {
        return $this->render(':Back/pages:editnews.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/event/{id}", name="back.event.edit")
     */
    public function editeventAction($id)
    {
        return $this->render(':Back/pages:editevent.html.twig', array(

        ));
    }


}