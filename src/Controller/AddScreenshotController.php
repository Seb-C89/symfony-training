<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddScreenshotController extends AbstractController
{
    #[Route('/add', name: 'app_add_screen')]
    public function index(): Response
    {
        return $this->render('Page/addScreenshot.html.twig', [

        ]);
    }
}
