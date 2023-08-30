<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index')]
    public function index(): Response
    {
        return $this->render('/pages/home.html.twig');
    }

    #[Route('/inscription', name: 'user_add')]
    public function registration(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $manager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $manager->persist($user);
            $manager->flush();
            // do anything else you need here, like send an email

            // $this->addFlash(
            //     'success',
            //     'l\'utilisateur a bien été ajouter!'
            // );

            return $this->redirectToRoute('user_index');
        }

        return $this->render('pages/security/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    
}
