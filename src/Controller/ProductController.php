<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    // #[Route('/produit', name: 'product_index')]
    // public function index(ProductRepository $repo): Response
    // {
    //     $products = $repo->findAll();
    //     return $this->render('pages/product/index.html.twig', [
    //         'products' => $products
    //     ]);
    // }

    // #[Route('/produit/ajouter', name: 'product_add')]
    // public function add(Request $request, EntityManagerInterface $manager): Response
    // {
    //     $product = new Product();

    //     $form = $this->createForm(ProductType::class, $product);

    //     $form->handleRequest($request);


    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $product = $form->getData();

    //         $manager->persist($product);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             'Votre produit a bien été ajouter!'
    //         );

    //         return $this->redirectToRoute('product_index');
    //     }

    //     return $this->render('pages/product/add.html.twig', [
    //         'form' => $form->createView(),

    //     ]);
    // }

    // #[Route('/produit/modifier/{id}', name: 'product_edit')]
    // public function edit(EntityManagerInterface $manager, Request $request, Product $product): Response
    // {
    //     $form = $this->createForm(ProductType::class, $product);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $product = $form->getData();

    //         // semblable a un git commit ""
    //         $manager->persist($product);
    //         //senblable a un git push
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             'Votre produit a bien été modifier!'
    //         );

    //         return $this->redirectToRoute('product_index');
    //     }


    //     return $this->render('pages/product/edit.html.twig', [

    //         'form' => $form->createView()
    //     ]);
    // }

    // #[Route('/produit/suppression/{id}', 'product_delete', methods: ['GET'])]
    // public function delete(EntityManagerInterface $manager, Product $product): Response
    // {
    //     $manager->remove($product);
    //     $manager->flush();

    //     $this->addFlash(
    //         'success',
    //         'Votre produit a bien été supprimer!'
    //     );

    //     return $this->redirectToRoute('product_index');
    // }
}
