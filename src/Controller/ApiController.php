<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class  ApiController extends AbstractController
{
    /**
     * @Route("/apiindex", name="api_index", methods={"GET"})
     * 
     */
    public function ApiIndex(ProductRepository $productRepository): Response
    {
//        aceasta ruta nu se foloseste . este ca exemplu de randare a tuturor produselor
       $products = $this->getDoctrine()->getManager()
        ->createQuery('SELECT p FROM App\Entity\Product p WHERE p.dataStop >= CURRENT_DATE()')
        ->getResult();
      

       
     
    return new JsonResponse($products);
 
    }

    
     /**
     * @Route("/api/{productId}", name="api_show", methods={"GET"},requirements={"productId":"\d+"})
     */
    public function show($productId): Response
    {
        
       $repo =$this->getDoctrine()->getRepository(Product::class);
       $product = $repo->findOneBy([
           'productId'=>$productId
       ]);        
      

      return new JsonResponse($product);

    }
}



