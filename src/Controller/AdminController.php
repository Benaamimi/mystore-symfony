<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Entity\Product;
use App\Form\RolesType;
use App\Form\ProductType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


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
        $form = $this->createForm(RolesType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // semblable a un git commit ""
            $manager->persist($user);
            //senblable a un git push
            $manager->flush();

            $this->addFlash(
                'success',
                'Le status de l\'utilisateur a bien été modifier!'
            );

            return $this->redirectToRoute('user_index');
        }


        return $this->render('pages/admin/registration/edit.html.twig', [

            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/membre/suppression/{id}', name:'user_delete')]
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
    public function add(Request $request, EntityManagerInterface $manager, Product $product = null,  SluggerInterface $slugger): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $imageFile = $form->get('image')->getData();

            
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);

                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('img_upload'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $product->setImage($newFilename);

            }

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
    public function modif(EntityManagerInterface $manager, Request $request, Product $product, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            
            $imageFile = $form->get('image')->getData();

            
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);

                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('img_upload'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $product->setImage($newFilename);

            }
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

    #[Route('/admin/produit/suppression/{id}', name:'product_delete')]
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

    //commandes

    #[Route('/admin/commande', name: 'orders_index')]
    public function display(OrdersRepository $repo, EntityManagerInterface $manager): Response
    {

        // $colonnes = $manager->getClassMetadata(Orders::class)->getFieldNames();

        $orders = $repo->findAll();
        return $this->render('pages/admin/orders/index.html.twig', [
            'orders' => $orders,
            // 'colonnes' => $colonnes

        ]);
    }

    #[Route('/admin/commande/suppression/{id}', name:'order_delete')]
    public function supprim(EntityManagerInterface $manager, Orders $order): Response
    {
        $manager->remove($order);
        $manager->flush();

        $this->addFlash(
            'success',
            'La commande a bien été supprimer!'
        );

        return $this->redirectToRoute('orders_index');
    }

   
    






}
