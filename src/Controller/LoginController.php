<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request): Response
    {
        $user = new User();
		
		$form = $this->createForm(LoginType::class, $user);
		
		$form->handleRequest($request);
        
		if ($form->isSubmitted() && $form->isValid()) {
			dump($user);
		}
		
		return $this->render('Page\Login.html.twig', [
			'form' => $form
		]);
    }
}
