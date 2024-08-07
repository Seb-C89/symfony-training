<?php

namespace App\Controller\api;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetMorePostController extends AbstractController
{
    #[Route('/api/post/{id}', name: 'api_getmorepost', methods: ['GET'])]
    public function index(int $id, PostRepository $postRepository): Response
    {
        $Posts = $postRepository->getMorePosts($id);

        return new JsonResponse(array(
            'posts' => $this->renderBlockView('@Page/Gallery.html.twig', "gallery", [
                'posts' => array_map(function($post){
                    return (object)array('img' => $post->getFile()->getName(), 'user_name' => $post->getUserName(), 'game' => $post->getGame(), 'date' => $post->getDate()->format('d/m/Y'));
                }, $Posts)
            ]),
            'lastid' => end($Posts) ? current($Posts)->getId() : -1
        ));
    }
}
