<?php

namespace App\Controller;

use ApiPlatform\Api\IriConverterInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(
        IriConverterInterface $iriConverterInterface,
        #[CurrentUser] User $user = null
    ): Response {

        if (!$user) {
            return $this->json([
                'error' => 'You should use \'Content-Type\': \'application/json header\'',
                'user' => $user
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new Response(null, Response::HTTP_NO_CONTENT, [
            'Location' => $iriConverterInterface->getIriFromResource($user)
        ]);
    }


    #[Route('/logout', name:'app_logout')]
    public function logout(): void
    {
        throw new \Exception('This shoud never be reached');
    }
}
