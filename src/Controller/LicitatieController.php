<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use App\Form\LicitatieType;
use App\Entity\Licitatie;
use App\Repository\LicitatieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use App\controller\MyProductController;




class LicitatieController extends AbstractController
{


/**
 * @Route("licitatie/add", name="addLicitatie", methods={"GET", "POST"},requirements={"productId":"\d+"})
 * @param Request $request
*/
    public function addLicitatie(Request $request)
    {
    
        $this->denyAccessUnlessGranted(['ROLE_USER']);
        if(!$request->request->has('pretLicitat') ){
           return $this->redirectToRoute('product_index');
//         
        } 
       
//        
          $productId = $request->query->get('productId');
//exista 2 moduri de a trimite Id produsului in controller
//1. cu input tipe hidden si avole luat cu $request->request->get('productId')
//2. cu action="{{path('addLicitatie', {'productId': product.productId})}} si acolo luat cu $request->request->get('productId')"#}
        
       
       
        $userId = $this->getUser()->GetUserId();
//if not emty
             $pretLicitat= $request->request->get('pretLicitat'); 
             $dataPret = date("Y-m-d H:i:s");
             $dataPretLicitat = new \DateTime($dataPret);
            
             
             $licitatie = new Licitatie($productId, $userId, $pretLicitat, $dataPretLicitat);
             $repo = $this ->getDoctrine()-> getRepository(Product::class);  
            $produsLicitat=$repo->findOneBy([
             'productId' => $licitatie->getProductId()      
         ]);
             $ultimulPretLicitat = $produsLicitat->getUltimulPretLicitat();
             if ($pretLicitat>$ultimulPretLicitat){
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($licitatie);
            $entityManager->flush();
             }     
             else Return new Response('Pretul Licitat trebuie sa fie mai mare decat Ultimul Pret Licitat');
//            iau ultim pret licitat din Product, gasesc Id produsului 
//            comparandu-l cu idProdusului din Licitatii (ultima Licitatie care s-a facut mai sus)
//            apoi la produsul licitat ii updatez ultimul pret licitat 
             
         $repo = $this ->getDoctrine()-> getRepository(Product::class);  
         $produsLicitat=$repo->findOneBy([
             'productId' => $licitatie->getProductId()      
         ]);
         $produsLicitat->setUltimulPretLicitat($pretLicitat);
         
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($produsLicitat);
         $entityManager->flush();
                 
//        $productId = $request->getSession()->get('productId');
//         $sproduct =  $repo->findBy(['productId' =>$productId]);      
             return $this->redirectToRoute('product_index');
        
//         return new Response ('form is submitted');
         
//         public function getProduct(){
//             
//             
//             
//         }
                 
//       return $this->render('licitatie/_licitatieForm.html.twig', [
//                 'product' => $product,
//                   'Licitatie' => $form->createView(),
//      ]);
//        
    }
    
//    return new Response ('form is submitted');
//    return $this->render('licitatie/_licitatieForm.html.twig', [
////               'product' => $product,
//                   'form' => $form->createView(),
//        ]);
//    return $this->redirectToRoute('product_new');
//    return $this->render('product/show.html.twig', [
////         'product' => $product,
//            'form' => $form->createView(),
//        ]);
 
}
