<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Licitatie;


/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     * 
     */
    public function index(ProductRepository $productRepository): Response
    {
//     
       $products = $this->getDoctrine()->getManager()
        ->createQuery('SELECT p FROM App\Entity\Product p WHERE p.dataStop >= CURRENT_DATE()')
        ->getResult();
       $userEmail = $this->getUser();
       
       if ($userEmail ==null){
        return $this->render('product/index.html.twig', [
            'products' => $products,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/index.html.twig', [
            'products' => $products,
        'user' => $userEmail->getEmail(),
            'message' =>''
     ]);              
    }  
    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     * @param Request $request
     */
    public function new(Request $request): Response
    {

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
       

        if ($form->isSubmitted() && $form->isValid()) {
             $file = $this->getUser()->getUserId();
             
//         $file = 2;     
//          $file = $request->getSession()->get('userId');
            $product->setUserId($file);
            $file = $product->getProductTitle();
            $product->setProductTitle($file);
            
            $file = $product->getProductDescription();
            $product->setProductDescription($file);
            
            $file = $product->getPhotoA();
            if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoA($fileName);
            }
  
            $file = $product->getPhotoB();
             if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoB($fileName);
             }
            $file = $product->getPhotoC();
              if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoC($fileName);
              }
            $file = $product->getPhotoD();
              if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoD($fileName);
              }
            $file = $product->getPhotoE();
              if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoE($fileName);
              }
             $file = $product->getPhotoF();
               if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoF($fileName);
               }
               
            $file = $product->getPretPornire();
            $product->setPretPornire($file);
            
            $product->setUltimulPretLicitat($file);
            
            
            
            $file = $product->getDataStop();
            
            $product->setDataStop($file);
            
            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
      
            
            

            return $this->redirectToRoute('my_products');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            ]);
    }
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


    /**
     * @Route("/{productId}", name="product_show", methods={"GET"},requirements={"productId":"\d+"})
     */
    public function show(Product $product): Response
    {
//         $repo = $this->getDoctrine()->getRepository(Licitatie::class);
//         $licitatie=$repo->findOneBy([
//             'productId'=>$product->getProductId() 
//         ], [
//             'dataPretLicitat'=>'DESC'
//         ]);
        $userEmail = $this->getUser();
     
       if ($userEmail ==null){
        return $this->render('product/show.html.twig', [
            'product' => $product,
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/show.html.twig', [
            'product' => $product,
        'user' => $userEmail->getEmail(),
            'message' =>''
     ]);               
        
        

    }
    
     

    /**
     * @Route("/{productId}", name="product_delete", methods={"DELETE"}, requirements={"productId":"\d+"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getProductId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
//    cart my favorites products
//    public function __construct() {
//        $cart = $request -> getSession()->get('cart');
//        if(!isset($cart)){
//            session()->put('cart', array());
//        }
//    }


/**
 * @Route("/myfavorites", methods={"GET"}, name="favorites")
 */
//    public function cart(Request  $request){
//       $session = $request -> getSession();
//                 
//         $cart = $session->get('cart');
//        
//         
//        if(!isset($cart)){
//            $cart = [];
//            $session->set('cart', array());
//           
//        }
//         $productId = $request->query->get('productId');
//        
//        $repo =$this->getDoctrine()->getRepository(Product::class);
//    $product=$repo->findOneBy([
//       'productId'=>$productId
//       ]);
//        
////        if(!$product) {
////            abort(404);
////        }
//        $cart = $session->get('cart');
//        
//        // if cart is empty then this the first product
//        
//        if(!$cart) {
//            
//            
//            $cart = [
//                $productId => [
//                    "Titlu" => $product->getProductTitle(),
//                    "Descriere" => $product->getProductDescription(),
//                    "photoA" => $product ->getPhotoA(),
//                    "pretPornire " => $product->getPretPornire(),
//                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
////                   "dataStop" => $product->getDataStop()
////                    "dataStop" => new \DateTime($product->getDataStop())
//                    
//                    
//                    
//                ]
//            ];
//       dump($cart);   
//            $session->set('cart', $cart);
//          
//               $this->addFlash(
//                'info',
//                'Produsul adaugat la favorite '
//            );
//               return $this->render('product/favorites.html.twig',[
//            'cart'=>$cart,
//            'product' =>$product
//        ]);
//
////            return new Response ('Product added to cart successfully!');
//        }
//        // if cart not empty then check if this product exist  and if not it will be add
//      
//        
//      
//        
//        if(isset($cart[$productId])) {
//       return new Response("este setat produsul $productId");
////            $this->addFlash(
////                'info',
////                'Produsul este deja la favorite ');
////             return $this->render('product/favorites.html.twig',[
////            'cart'=>$cart,
////            'product' =>$product
////        ]);
//        }
//        // if item not exist in cart then add to cart 
//       $productId = $request->query->get('productId'); 
//        $repo =$this->getDoctrine()->getRepository(Product::class);
//    $product=$repo->findOneBy([
//       'productId'=>$productId
//       ]);
//       
//        $productId = [
//                    "Title" => $product->getProductTitle(),
//                    "Description" => $product->getProductDescription(),
//                    "photoA" => $product ->getPhotoA(),
//                    "pretPornire " => $product->getPretPornire(),
//                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
//                    "dataStop" => $product->getDataStop()
//                ];
              
                
//        array_push($cart,$productId);
    
//    dump($dir);
//    $cart[$productId]
//                 = [
//                    "Titlu" => $product->getProductTitle(),
//                    "Descriere" => $product->getProductDescription(),
////                    "photoA" => "$dir".'/'.$product->getPhotoA(),
//                     "photoA" => 'uploads/'.$product->getPhotoA(),
//                    
////                      <img style="width: 200px; height: 250px" src="/uploads/{{ product.photoA }}" class="card-img-top" alt="...">
//                    "pretPornire " => $product->getPretPornire(),
//                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
////                   "dataStop" => $product->getDataStop()
//                
//            ];
//    
//    
//        $session->set('cart', $cart);
//      dump($session);
//               $this->addFlash(
//                'info',
//                'Produsul adaugat la favorite '
//            );
//        
//        
//        
//        
//        return $this->render('product/favorites.html.twig',[
//            'cart'=>$cart,
//            'product' =>$product
//        ]);
//    }
//}

//     public function addToCart(Request  $request)
//    {
//        $productId = $request->query->get('productId');
//        
//        $repo =$this->getDoctrine()->getRepository(Product::class);
//    $product=$repo->findOneBy([
//       'productId'=>$productId
//       ]);
//        
////        if(!$product) {
////            abort(404);
////        }
//        $cart = $session->get('cart');
//        // if cart is empty then this the first product
//        if(!$cart) {
//            $cart = [
//                $productId => [
//                    "Title" => $product->getProductTitle(),
//                    "Description" => $product->getProductDescription(),
//                    "photoA" => $product ->getPhotoA(),
//                    "pretPornire " => $product->getPretPornire(),
//                    "ultimulPretLicitat" => $product->getUltimulPretLicitat(),
//                    "dataStop" => $product->getDataStop()
//                ]
//            ];
//            $session()->set('cart', $cart);
//            return new Response ('Product added to cart successfully!');
//        }
//}
//}