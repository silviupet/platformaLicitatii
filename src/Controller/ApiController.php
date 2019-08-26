<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api",  methods={"GET", "POST"}, requirements={"productId":"\d+"}))
     * 
     */
    public function ultimulPretLicitat(Request $request): Response
    {
//        $productId = $request->query->get('productId');
         
        $repo=$this->getDoctrine()->getRepository(Product::class)->findAll();
      
          dump($repo);
        
        return new Response(json_encode($repo));
//      
    }
//        return $this->render('api/index.html.twig', [
//            'controller_name' => 'ApiController',
//        ]);
/**
 * @Route("/apiajax")
 * @return Response   
*/
    public function showUltimulPretLicitatAjax(){
      $repo=$this->getDoctrine()->getRepository(Product::class)->findAll();   
       return new Response (
                    $this->render('api/index.html.twig')
               );
               /*sau 'lucky_number.html.twig*/
//        ['repo' => $repo])
       
//        cross site scripting- s-a bagat in placeholderul 'message' un script javascript. 
//        dat twig are autoescape enabled by default. 
   
    }
}


