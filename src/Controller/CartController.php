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
//use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController {
//    private $session;
//
//    public function __construct(SessionInterface $session)
//    {
//        $this->session = $session;
//    }
/**
 * @Route("/myfavorites", methods={"GET"}, name="favorites")
 */
    public function indexCart(Request $request): Response{
       
//       $cart = $this->session->get('cart');
         $session = $request -> getSession();
         $cart = $session->get('cart');
       dump($cart);
        $repo =$this->getDoctrine()->getRepository(Product::class);
            $product=$repo;
            
            $userEmail = $this->getUser();
     
       if ($userEmail ==null){
        return $this->render('product/favorites.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/favorites.html.twig', [
            'cart'=>$cart,
            'product' => $product,
         'user' => $userEmail->getEmail(),
            'message' =>''
     ]);               
        
         
//          return $this->render('product/favorites.html.twig',[
//            'cart'=>$cart,
//            'product' =>$product,
//             'user'=>''
//           ]);
        
    }
/**
* @Route("addToFavorites", name="addToFavorites", methods={"GET", "POST"}, requirements={"productId":"\d+"})
* @param Request $request
*/  
public function addCart( Request $request): Response {
        $session = $request -> getSession();
        $cart = $session->get('cart');
//         $cart = $this->session->get('cart');
         
//         $cart = $session->get('cart');  
// daca nu este setat nimic in cart setam un array gol.         
    if(!isset($cart)){
            $cart = [];
//            $this->session->set('cart', array());
            $session->set('cart', array());
           
      }
       
       $productId = $request->query->get('productId');
      
    
       
       
        $repo =$this->getDoctrine()->getRepository(Product::class);
        $product=$repo->findOneBy([
            'productId'=>$productId
           ]);
       
////        if(!$product) {
////            abort(404);
////        }
//           $cart = $session->get('cart');
//           dump($cart);
        
// if cart is empty then this the first product
//        
        if(!$cart) {
            
            
            $cart = [
                $productId => [
                    "Titlu" => $product->getProductTitle(),
                    "Descriere" => $product->getProductDescription(),
//                    "photoA" => '<img style="width: 200px; height: 250px" src="/uploads/'.$product->getPhotoA(). 'class="card-img-top" alt="...">',
                  "photoA" => $product ->getPhotoA(),
                    "pretPornire " => $product->getPretPornire(),
                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
                 "dataStop" => $product->getDataStop()->format("Y-m-d")
//                    "dataStop" => new \DateTime($product->getDataStop())
                    
                    
                    
                ]
            ];
        }
//            $this->session->set('cart', $cart);
            $session->set('cart', $cart);
            
        // if cart not empty then check if this product exist  and if not it will be add
       
        if(isset($cart[$productId])) {
//       return new Response("este setat produsul $productId");
//            $this->addFlash(
//                'info',
//                'Produsul este deja la favorite ');
             $userEmail = $this->getUser();
            if ($userEmail ==null){
        return $this->render('product/favorites.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/favorites.html.twig', [
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
//                    "photoA" => "$dir".'/'.$product->getPhotoA(),
                    "photoA" => $product->getPhotoA(),
//                      "photoA" => '<img style="width: 200px; height: 250px" src="/uploads/'.$product->getPhotoA(). 'class="card-img-top" alt="...">',
                    
//                      <img style="width: 200px; height: 250px" src="/uploads/{{ product.photoA }}" class="card-img-top" alt="...">
                    "pretPornire " => $product->getPretPornire(),
                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
                  "dataStop" => $product->getDataStop()->format("Y-m-d")
                
            ];
    
//     $this->session->set('cart', $cart);
        $session->set('cart', $cart);
//        dump($session);
            
        $userEmail = $this->getUser();  
        
//             
             if ($userEmail ==null){
        return $this->render('product/favorites.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/favorites.html.twig', [
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
//        $cart = $request -> getSession()->get('cart');
        $productId = $request->query->get('productId');
        
      if($productId) {
          $session = $request -> getSession();
          
        $cart=$session->get('cart');
        dump($cart);
           if(isset($cart[$productId])) {
           unset($cart[$productId]);
               $session->set('cart', $cart);
            }
             $userEmail = $this->getUser();  
              $repo =$this->getDoctrine()->getRepository(Product::class);
            $product=$repo;
            dump($product);
//             
             if ($userEmail ==null){
        return $this->render('product/favorites.html.twig', [
            'cart'=>$cart,
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/favorites.html.twig', [
            'cart'=>$cart,
            'product' => $product,
         'user' => $userEmail->getEmail(),
            'message' =>''
     ]);               
       }
    }
}
