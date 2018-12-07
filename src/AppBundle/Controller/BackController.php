<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Event;
use AppBundle\Entity\Media;
use AppBundle\Entity\News;
use AppBundle\Form\Type\EventFormType;
use AppBundle\Form\Type\MediaFormType;
use AppBundle\Form\Type\NewsFormType;
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
     * @Route("/admin/media/{id}", name="back.media.edit", requirements={"id"="\d+"})
     */
    public function editmediaAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $media = $manager->getRepository('AppBundle:Media')
            ->find($id);

        $form= $this->createForm(MediaFormType::class, $media, array(
            'method'        => 'POST',
            'action'        => $this->generateUrl('back.media.edit', array(
                'id'    =>  $id
            ))
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $media = new Media();
            $media= $form->getData();
            $media->setUpdateAt(new \DateTime());
            $manager->persist($media);
            $manager->flush();

            return $this->redirectToRoute('back.media.edit',array(
                'id' => $id
            ));
        }

        return $this->render(':Back/pages:editmedia.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/admin/news/{id}", name="back.news.edit", requirements={"id"="\d+"})
     */
    public function editnewsAction(Request $request ,$id)
    {
        $manager = $this->getDoctrine()->getManager();
        $news = $manager->getRepository('AppBundle:News')
            ->find($id);

        $form = $this->createForm(NewsFormType::class, $news, array(
            'method'        => 'POST',
            'action'        => $this->generateUrl('back.news.edit', array(
                'id'    =>  $id
            ))
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $news = new News();
            $news= $form->getData();
            $news->setUpdateAt(new \DateTime());
            $manager->persist($news);
            $manager->flush();

            return $this->redirectToRoute('back.news.edit',array(
               'id' => $id
            ));
        }

        return $this->render(':Back/pages:editnews.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/admin/event/{id}", name="back.event.edit", requirements={"id"="\d+"})
     */
    public function editeventAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $event = $manager->getRepository('AppBundle:Event')
            ->find($id);

        $form = $this->createForm(EventFormType::class, $event, array(
            'method'        => 'POST',
            'action'        => $this->generateUrl('back.event.edit', array(
                'id'    =>  $id
            ))
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $event = new Event();
            $event= $form->getData();
            $event->setUpdateAt(new \DateTime());
            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('back.event.edit',array(
                'id' => $id
            ));
        }

        return $this->render(':Back/pages:editevent.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/admin/event/add", name="back.event.add")
     */
    public function addeventAction(Request $request)
    {
        $form = $this->createForm(EventFormType::class,new Event() , array(
            'method'        => 'POST',
            'action'        => $this->generateUrl('back.event.add', array(

            ))
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();

            $event= $form->getData();
            $event->setUpdateAt(new \DateTime());
            $event->setCreatedAt(new \DateTime());
            $event->setAuthor($this->getUser());


            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('back.event',array(

            ));
        }

        return $this->render(':Back/pages:addevent.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/admin/media/add", name="back.media.add")
     */
    public function addmediaAction(Request $request)
    {
        $form = $this->createForm(MediaFormType::class,new Media() , array(
            'method'        => 'POST',
            'action'        => $this->generateUrl('back.media.add', array(

            ))
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();

            $event= $form->getData();
            $event->setUpdateAt(new \DateTime());
            $event->setPublishedAt(new \DateTime());
            $event->setAuthor($this->getUser());


            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('back.media',array(

            ));
        }

        return $this->render(':Back/pages:addmedia.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/admin/news/add", name="back.news.add")
     */
    public function addnewsAction(Request $request)
    {
        $form = $this->createForm(NewsFormType::class,new News() , array(
            'method'        => 'POST',
            'action'        => $this->generateUrl('back.news.add', array(

            ))
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();

            $event= $form->getData();
            $event->setUpdateAt(new \DateTime());
            $event->setCreatedAt(new \DateTime());
            $event->setAuthor($this->getUser());


            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('back.news',array(

            ));
        }

        return $this->render(':Back/pages:addnews.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * @Route("/admin/event/delete/{id}", name="back.event.delete", requirements={"id"="\d+"})
     */
    public function deleteeventAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $event = $manager->getRepository('AppBundle:Event')
            ->find($id);
        $manager->remove($event);
        $manager->flush();

        return $this->redirectToRoute('back.event');
    }

    /**
     * @Route("/admin/media/delete/{id}", name="back.media.delete", requirements={"id"="\d+"})
     */
    public function deletemediaAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $event = $manager->getRepository('AppBundle:Media')
            ->find($id);
        $manager->remove($event);
        $manager->flush();

        return $this->redirectToRoute('back.media');
    }

    /**
     * @Route("/admin/news/delete/{id}", name="back.news.delete", requirements={"id"="\d+"})
     */
    public function deletenewsAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $event = $manager->getRepository('AppBundle:News')
            ->find($id);
        $manager->remove($event);
        $manager->flush();

        return $this->redirectToRoute('back.news');
    }
}