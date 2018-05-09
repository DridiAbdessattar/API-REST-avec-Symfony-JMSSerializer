<?php

namespace App\Controller;

use App\Entity\JeuxVideo;
use App\Form\JeuxVideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jeux/video")
 */
class JeuxVideoController extends Controller
{
    /**
     * @Route("/", name="jeux_video_index", methods="GET")
     */
    public function index(): Response
    {
        $jeuxVideos = $this->getDoctrine()
            ->getRepository(JeuxVideo::class)
            ->findAll();

        return $this->render('jeux_video/index.html.twig', ['jeux_videos' => $jeuxVideos]);
    }

    /**
     * @Route("/new", name="jeux_video_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $jeuxVideo = new JeuxVideo();
        $form = $this->createForm(JeuxVideoType::class, $jeuxVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jeuxVideo);
            $em->flush();

            return $this->redirectToRoute('jeux_video_index');
        }

        return $this->render('jeux_video/new.html.twig', [
            'jeux_video' => $jeuxVideo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{uid}", name="jeux_video_show", methods="GET")
     */
    public function show(JeuxVideo $jeuxVideo): Response
    {
        return $this->render('jeux_video/show.html.twig', ['jeux_video' => $jeuxVideo]);
    }

    /**
     * @Route("/{uid}/edit", name="jeux_video_edit", methods="GET|POST")
     */
    public function edit(Request $request, JeuxVideo $jeuxVideo): Response
    {
        $form = $this->createForm(JeuxVideoType::class, $jeuxVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jeux_video_edit', ['uid' => $jeuxVideo->getUid()]);
        }

        return $this->render('jeux_video/edit.html.twig', [
            'jeux_video' => $jeuxVideo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{uid}", name="jeux_video_delete", methods="DELETE")
     */
    public function delete(Request $request, JeuxVideo $jeuxVideo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeuxVideo->getUid(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jeuxVideo);
            $em->flush();
        }

        return $this->redirectToRoute('jeux_video_index');
    }
}
