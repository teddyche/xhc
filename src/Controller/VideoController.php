<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{

    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(VideoRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/videos", name="video.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('video/index.html.twig', [
            'current_menu' => 'videos'
        ]);
    }

    /**
     * @Route("/video/{slug}-{id}", name="video.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Video $video
     * @return Response
     */
    public function show(Video $video, string $slug): Response
    {
        if ($video->getSlug() !== $slug) {
            return $this->redirectToRoute('video.show', [
               'id' => $video->getId(),
               'slug' => $video->getSlug()
            ], 301);
        }
        return $this->render('video/show.html.twig', [
            'video' => $video,
            'current_menu' => 'videos'
        ]);
    }
}