<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    
    #[Route('/admin', name: 'admin')]
    // public function admin(): Response
    // {
    //     return $this->render('pages/admin/index.html.twig');
    // }

    //Membre
    
    #[Route('/admin/membre', name: 'user_index')]
    public function index(UserRepository $repo): Response
    {
        $users = $repo->findAll();
        return $this->render('pages/admin/registration/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/membre/modifier/{id}', name: 'user_edit')]
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


        return $this->render('pages/admin/registration/edit.html.twig', [

            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/produit/suppression/{id}', 'user_delete', methods: ['GET'])]
    public function supprimer(EntityManagerInterface $manager, User $user): Response
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            'l\'utilisateur a bien été supprimer!'
        );

        return $this->redirectToRoute('user_index');
    }




    //Produit

    #[Route('/admin/produit', name: 'product_index')]
    public function indx(ProductRepository $repo): Response
    {
        $products = $repo->findAll();
        return $this->render('pages/admin/product/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/admin/produit/ajouter', name: 'product_add')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $manager->persist($product);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre produit a bien été ajouter!'
            );

            return $this->redirectToRoute('product_index');
        }

        return $this->render('pages/admin/product/add.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    #[Route('/admin/produit/modifier/{id}', name: 'product_edit')]
    public function modif(EntityManagerInterface $manager, Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            // semblable a un git commit ""
            $manager->persist($product);
            //senblable a un git push
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre produit a bien été modifier!'
            );

            return $this->redirectToRoute('product_index');
        }


        return $this->render('pages/admin/product/edit.html.twig', [

            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/produit/suppression/{id}', 'product_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Product $product): Response
    {
        $manager->remove($product);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre produit a bien été supprimer!'
        );

        return $this->redirectToRoute('product_index');
    }




}
