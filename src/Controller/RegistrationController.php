<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/membre', name: 'user_index')]
    public function index(UserRepository $repo): Response
    {
        $users = $repo->findAll();
        return $this->render('pages/registration/index.html.twig', [
            'users' => $users
        ]);
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

        return $this->render('pages/registration/add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/membre/modifier/{id}', name: 'user_edit')]
    public function edit(EntityManagerInterface $manager, Request $request, User $user): Response
    {
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // semblable a un git commit ""
            $manager->persist($user);
            //senblable a un git push
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'utilisateur a bien été modifier!'
            );

            return $this->redirectToRoute('user_index');
        }


        return $this->render('pages/registration/edit.html.twig', [

            'form' => $form->createView()
        ]);
    }

}
