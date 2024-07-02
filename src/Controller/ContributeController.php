<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Post;
use App\Form\ContributeType;
use App\Form\MessageType;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ContributeController extends AbstractController
{
    #[Route('/contribute', name: 'contribute')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepo): Response
    {
        $newpost = new Post($userRepo->findOneBy(['mail' => $this->getUser()->getUserIdentifier()]));

        $form = $this->createForm(ContributeType::class, $newpost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['screenshoot']->getData();
            if($file->isValid()) {
                if(preg_match("#image/.*#", $file->getMimeType())){
                    $newFileName = date("YmdHis") . '.' . $file->guessExtension();
                    $file->move($this->getParameter('kernel.project_dir') . '/public/uploads', $newFileName);

                    $newpost->setFile(new File($newFileName, null, null, $newpost));

                    $entityManager->persist($newpost);
                    //$entityManager->persist($newfile);
                    $entityManager->flush();
                }
            }
        }

        return $this->render('Page/Contribute.html.twig', [
            'form' => $form,
        ]);
    }
}
