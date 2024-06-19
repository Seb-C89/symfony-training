<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    #[Route('/gallery', name: 'gallery')]
    #[Route('/gallery/{id}', name: 'gallery/slug')] #need different name because it will erase the precedent
    public function index(PostRepository $postRepository, int $id=0): Response
    {
        $Posts = $postRepository->findBy(['status' => 'OK'], ['date' => 'DESC'], 5);
        $Games = $postRepository->getAllDistinctGameName();

        $last_id = end($Posts)->getId();

        dump($Posts);
        dump($Games);
        dump($last_id);
        dump($id);

        return $this->render('Page/Gallery.html.twig', [
            'posts' => array_map(function($post){
                return (object)array('img' => "src", 'user_name' => $post->getUserName(), 'game' => $post->getGame(), 'date' => $post->getDate()->format('d/m/Y'));
            }, $Posts),
            'games' => array_map(function($game){
                return $game["game"];
            }, $Games),
            'last_id' => $last_id,
        ]);
    }
}
