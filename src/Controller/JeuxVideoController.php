<?php

namespace App\Controller;

use App\Entity\JeuxVideo;
use App\Form\JeuxVideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializationContext;

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
        $data = $this->get('jms_serializer')->serialize($jeuxVideos, 'json',SerializationContext::create()->setGroups(array('list')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * @Route("/add", name="jeux_video_new", methods="POST")
     */
    public function new(Request $request): Response
    {
        $data = $request->getContent();
        $jeuxVideos = $this->get('jms_serializer')->deserialize($data, 'App\Entity\JeuxVideo', 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($jeuxVideos);
        $em->flush();
        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/{uid}", name="jeux_video_show", methods="GET")
     */
    public function show(JeuxVideo $jeuxVideo): Response
    {
        $data = $this->get('jms_serializer')->serialize($jeuxVideo, 'json',SerializationContext::create()->setGroups(array('detail')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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
