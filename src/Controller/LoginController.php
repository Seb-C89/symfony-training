<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request, UserRepository $userRepository, LoginLinkHandlerInterface $loginLinkHandler): Response
    {
        $user = new User();
		
		$form = $this->createForm(LoginType::class, $user);
		
		$form->handleRequest($request);
        
		if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getMail()) { // TODO redundant with $form->isvalid() ?
                $user_from_db = $userRepository->findOneBy(['mail' => $user->getMail()]);
                if($user_from_db) {
                    $loginLinkDetails = $loginLinkHandler->createLoginLink($user_from_db);
                    $magickLink = $loginLinkDetails->getUrl();
                }
            }
		}
		
		return $this->render('Page\Login.html.twig', [
			'form' => $form,
            'magickLink' => ($magickLink ?? null)
		]);
    }
}
