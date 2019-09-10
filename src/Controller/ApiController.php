<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    /**
     * @Route("/apiindex", name="api_index", methods={"GET"})
     * 
     */
    public function ApiIndex(ProductRepository $productRepository): Response
    { 
       $products = $this->getDoctrine()->getManager()
        ->createQuery('SELECT p FROM App\Entity\Product p WHERE p.dataStop >= CURRENT_DATE()')
        ->getResult();
      
//   $products.JSON.parse();
       
     
    return new JsonResponse($products);
 
    }

    
     /**
     * @Route("/api/{productId}", name="api_show", methods={"GET"},requirements={"productId":"\d+"})
     */
    public function show(Product $product, Request $request): Response
    {
        
        $productId = $request->query->get('ProductId');
       $repo =$this->getDoctrine()->getRepository(Product::class);
       $product = $repo->findOneBy([
           'productId'=>$productId
       ]);        
      
       dump($product);
      return new Response(json_encode($product));
//        
    }
}
//    /**
//     * @Route("/api", name="api",  methods={"GET", "POST"}, requirements={"productId":"\d+"}))
//     * 
//     */
//    public function ultimulPretLicitat(Request $request): Response
//    {
////        $productId = $request->query->get('productId');
//         
//        $repo=$this->getDoctrine()->getRepository(Product::class)->findAll();
//      
//          dump($repo);
//        
//        return new Response(json_encode($repo));
////      
//    }
////        return $this->render('api/index.html.twig', [
////            'controller_name' => 'ApiController',
////        ]);
///**
// * @Route("/apiajax")
// * @return Response   
//*/
//    public function showUltimulPretLicitatAjax(){
//      $repo=$this->getDoctrine()->getRepository(Product::class)->findAll();   
//       return new Response (
//                    $this->render('api/index.html.twig')
//               );
//               /*sau 'lucky_number.html.twig*/
////        ['repo' => $repo])
//       
////        cross site scripting- s-a bagat in placeholderul 'message' un script javascript. 
////        dat twig are autoescape enabled by default. 
//   
//    }
//}


