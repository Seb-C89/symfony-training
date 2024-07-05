<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/*
 * Used to declare some utility route, therefor they are automatically prefixed in prod.
 */

class GhostsController extends AbstractController
{
    #[Route('/uploads', name: 'upload')]
    public function index(): Response {
        throw $this->createNotFoundException('');
    }
}
