<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Message;
use App\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Message();
        $message->setReplyTo($this->getUser()->getUserIdentifier());
		
		$form = $this->createForm(MessageType::class, $message);
		
		$form->handleRequest($request);
        
		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($message);
			$entityManager->flush();
			dump($message);
		}
		
		return $this->render('Page\Contact.html.twig', [
			'form' => $form
		]);
    }
}
