<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Licitatie;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends AbstractController {
/**
 * @Route("/mycart", methods={"GET"}, name="mycart")
 */
//acest controller nu este functional. este facut ca exercitiu
    public function indexCart(Request $request): Response{
         $session = $request -> getSession();
         $cart = $session->get('cart');
         $repo =$this->getDoctrine()->getRepository(Product::class);
         $product=$repo;
            
         $userEmail = $this->getUser();
     
         if ($userEmail ==null){
         return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
            'user' => $userEmail->getEmail(),
            'message' =>''
     ]);
    }
/**
* @Route("addToCart", name="addToCart", methods={"GET", "POST"}, requirements={"productId":"\d+"})
* @param Request $request
*/  
public function addCart( Request $request): Response {
    $session = $request -> getSession();
    $cart = $session->get('cart');

    if(!isset($cart)){
            $cart = [];
            $session->set('cart', array());
           
      }
       
       $productId = $request->query->get('productId');
      
    
       
       
        $repo =$this->getDoctrine()->getRepository(Product::class);
        $product=$repo->findOneBy([
            'productId'=>$productId
           ]);
       

        
// if cart is empty then this the first product

        if(!$cart) {
            
            
            $cart = [
                $productId => [
                    "Titlu" => $product->getProductTitle(),
                    "Descriere" => $product->getProductDescription(),
                    "photoA" => $product ->getPhotoA(),
                    "pretPornire " => $product->getPretPornire(),
                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
                    "dataStop" => $product->getDataStop()->format("Y-m-d")
                ]
            ];
        }

            $session->set('cart', $cart);
            
            
        // if cart not empty then check if this product exist  and if not it will be add
       
        if(isset($cart[$productId])) {
             $userEmail = $this->getUser();
            if ($userEmail ==null){
            return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
            'user' => $userEmail->getEmail(),
            'message' =>''
     ]);               
        }
     // if item not exist in cart then add to cart    
        $cart[$productId]
                 = [
                    "Titlu" => $product->getProductTitle(),
                    "Descriere" => $product->getProductDescription(),
                    "photoA" => $product->getPhotoA(),
                    "pretPornire " => $product->getPretPornire(),
                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
                    "dataStop" => $product->getDataStop()->format("Y-m-d")
                
            ];
    

        $session->set('cart', $cart);

        $userEmail = $this->getUser();
             if ($userEmail ==null){
            return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
            'user' => $userEmail->getEmail(),
            'message' =>''
     ]);               
    }
/**
* @Route("removecart", name="removecart", methods={"GET", "POST"}, requirements={"productId":"\d+"})
* @param Request $request
*/  
    public function removeCart(Request $request)
    {

        $productId = $request->query->get('productId');
        
      if($productId) {
          $session = $request -> getSession();
          
        $cart=$session->get('cart');

           if(isset($cart[$productId])) {
           unset($cart[$productId]);
               $session->set('cart', $cart);
            }
             $userEmail = $this->getUser();  
              $repo =$this->getDoctrine()->getRepository(Product::class);
            $product=$repo;

//             
             if ($userEmail ==null){
        return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('cart/index.html.twig', [
            'cart'=>$cart,
            'product' => $product,
         'user' => $userEmail->getEmail(),
            'message' =>''
     ]);               
       }
    }
}
