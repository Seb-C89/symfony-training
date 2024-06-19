<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepository): Response
    {
        $Posts = $postRepository->findAll();
        $Games = $postRepository->getAllDistinctGameName();
        dump($Posts);
        dump($Games);
        return $this->render('Page/Gallery.html.twig', [
            'posts' => array_map(function($post){
                return (object)array('img' => "src", 'user_name' => $post->getUserName(), 'game' => $post->getGame());
            }, $Posts),
            'games' => array_map(function($game){
                return $game["game"];
            }, $Games)
        ]);
    }
}
