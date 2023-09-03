<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdersController extends AbstractController
{
    #[Route('/commande', name: 'orders')]
    public function index(OrdersRepository $repo): Response
    {
        return $this->render('pages/orders/index.html.twig', [
            'orders' => $repo->findAll()
        ]);
    }
    
    #[Route('commande/ajout', name: 'orders_add')]
    public function add(SessionInterface $session, ProductRepository $repo, EntityManagerInterface $manager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('cart', []);

        
        // $panier = $cs->getCartWithData('cart', []);
        // $panier = $session->$this->getCartWithData();
        
        // if($panier === [])
        // {
            //     $this->addFlash('message', 'Votre panier est vide');
            //     return $this->redirectToRoute('home_index');
            // }
            // $order = new Orders;
            
            
            foreach($panier as $item => $quantity)
            // foreach($panier as $item )
            {
            
            $order = new Orders;
            
            $product = $repo->find($item);
            
            $price = $product->getPrice();
            // $stock = $product->getStock();
            
            $order->setUsers($this->getUser());
            $order->setProducts($product);
            $order->setTotalPrice($price);
            $order->setQuantity($quantity);
            // $order->setQuantity($stock);
            
            // dd($order);
        }
        $manager->persist($order);
        
        
        $manager->flush();
        
        
        $session->remove('cart');
        
        $this->addFlash(
            'success',
            'Votre article a bien été commander!'
        );
        
        // dd($order);
        return $this->redirectToRoute('home_index');
        
        

    // #[Route('/commande/liste', name: 'orders')]
    // public function display(OrdersRepository $repo): Response
    // {


    //     $orders = $repo->findAll();
    //     return $this->render('pages/order/index.html.twig', [
    //         'orders' => $orders
    //     ]);

    
    }


   
}
