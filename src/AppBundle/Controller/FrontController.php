<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {

        $form = $this->createForm(ContactFormType::class, null,array(
            'action'    => $this->generateUrl('front.contact'),
            'method'    => 'POST'
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $message = (new \Swift_Message("New Mail"))
                ->setFrom($data['email'])
                ->setTo($this->getParameter('mailer_user'))
                ->setBody($this->renderView(':Emails:contact.html.twig', array(
                    'data'  =>  $data
                ))
                    ,
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('front.contact');
        }
        return $this->render(':Front:contact.html.twig', array(
            'form'  =>  $form->createView()
        ));
    }

    /**
     * @Route("/event", name="front.event")
     */
    public function eventAction()
    {
        $manager = $this->getDoctrine()->resetManager();
        $lastevent = $manager->getRepository('AppBundle:Event')
            ->findBy(array(), array('date' => 'asc'), 5 , 0);
        $events = $manager->getRepository('AppBundle:Event')
            ->findBy(array(), array('date' => 'asc'), 10 , 0);
        return $this->render(':Front:event.html.twig', array(
            'events'        =>  $events,
            'lastEvent'     =>  $lastevent,
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
    public function newsAction( Request $request)
    {
        $manager    = $this->get('doctrine.orm.entity_manager');
        $dql        = "SELECt a FROM AppBundle:News a";
        $query      = $manager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination  = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render(':Front:news.html.twig',array(
            'pagination'    => $pagination
        ));
    }

    /**
     * @Route("/view/{id}", name="front.news.view")
     */
    public function viewNewsAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $news = $manager->getRepository('AppBundle:News')
            ->find($id);
        $lastNews = $manager->getRepository('AppBundle:News')
            ->findBy(array(), array('createdAt' => 'asc'), 3 , 0);
        return $this->render(':Front:viewnews.html.twig', array(
            'news'      =>  $news,
            'lastNews'  => $lastNews,
        ));
    }


}
