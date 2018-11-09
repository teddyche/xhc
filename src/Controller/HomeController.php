<?php
/**
 * Created by Teddy.
 * User: 33769
 * Date: 08/11/2018
 * Time: 01:28
 */
namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="home")
     * @param VideoRepository $repository
     * @return Response
     */
    public function index(VideoRepository $repository): Response
    {
        $videos = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'videos' => $videos
        ]);
    }
}