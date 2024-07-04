<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginLogoutController extends AbstractController
{
    #[Route('/logout', name: 'logout')]
    public function logout():  never
    {
        throw new \LogicException('This code should never be reached');
    }
}
