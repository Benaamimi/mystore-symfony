<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(CartService $cs): Response
    {
        return $this->render('pages/panier/index.html.twig', [
            'items' => $cs->getCartWithData(),
            'total' => $cs->getTotal()
        ]);
    }

    #[Route('/cart/plus/{id}', name: 'plus')]
    public function plus($id, CartService $cs)
    {
        $cs->add($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add($id, CartService $cs)
    {
        $cs->add($id);
        return $this->redirectToRoute('home_index');
    }


    #[Route('/cart/retirer/{id}', name:'cart_remove')]
    public function remove($id, CartService $cs)
    {
        $cs->remove($id);
        return $this->redirectToRoute('cart');
  
    }
}
