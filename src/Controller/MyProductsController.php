<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Product;
use App\Form\EditFormType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Licitatie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\DateTime;







class MyProductsController extends AbstractController
{
    /**
     * @Route("/myproducts", name="my_products")
     */
    public function index(ProductRepository $productRepository): Response
    {
         $userEmail = $this->getUser();
       
       if ($userEmail ==null){
        return $this->render('my_products/index.html.twig', [
            'products' => $productRepository->findBy([
                'userId' => $this->getUser()->getUserId()
                     ]),
//          'user' => $userEmail->getEmail(),
            'message' =>''
      
       ]);               
       } else 
        return $this->render('my_products/index.html.twig', [
            'products' => $productRepository->findBy([
                'userId' => $this->getUser()->getUserId()
                     ]),
         'user' => $userEmail->getEmail(),
            'message' =>''
    
            ]);
        
//        return $this->render('my_products/index.html.twig', [
//            'products' => $productRepository->findBy([
//                'userId' => $this->getUser()->getUserId()
//            ]),
//        ]);
    }





 /**
 * @Route("myproducts/{productId}/edit", name="product_edit", methods={"GET","POST"},requirements={"ProductId":"\d+"})
 *
 */
    public function edit(Request $request, Product $product): Response
    {
        
     
    $repo =$this->getDoctrine()->getRepository(Product::class);
    $product=$repo->findOneBy([
       'productId'=>$product->getProductId()
       ]);
    $productId = $request->request->get('productId');
    $productTitle = $request->request->get('productTitle');
    $productDescription = $request->request->get('productDescription');
    $photoA = $request -> files -> get('photoA');
    $photoB = $request -> files -> get('photoB');
    $photoC = $request -> files -> get('photoC');
    $photoD = $request -> files -> get('photoD');
    $photoE = $request -> files -> get('photoE');
    $photoF = $request -> files -> get('photoF');
    $category = $request->request->get('category');
    $pretPornire = $request->request->get('pretPornire');
    $dataStop = $request->request->get('dataStop');
    
    
    
    
    
    
    
    

    if(!empty($productTitle )){
            $product-> setProductTitle($productTitle);
    }
    if(!empty($productDescription )){
            $product-> setProductDescription($productTitle);
    }
    if(!empty($photoA)){
         $fileName = $this->generateUniqueFileName().'.'.$photoA->guessExtension();
            $photoA->move(
            $this->getParameter('Photo_directory'),
                $fileName
                    );         
     $product->setPhotoA($fileName);
 }
     if(!empty($photoB)){
         $fileName = $this->generateUniqueFileName().'.'.$photoB->guessExtension();
            $photoB->move(
            $this->getParameter('Photo_directory'),
                $fileName
                    );         
     $product->setPhotoB($fileName);
 }
 if(!empty($photoC)){
         $fileName = $this->generateUniqueFileName().'.'.$photoC->guessExtension();
            $photoC->move(
            $this->getParameter('Photo_directory'),
                $fileName
                    );         
     $product->setPhotoC($fileName);
 }
     if(!empty($photoD)){
         $fileName = $this->generateUniqueFileName().'.'.$photoD->guessExtension();
            $photoD->move(
            $this->getParameter('Photo_directory'),
                $fileName
                    );         
     $product->setPhotoD($fileName);
     }
     if(!empty($photoE)){
         $fileName = $this->generateUniqueFileName().'.'.$photoE->guessExtension();
            $photoE->move(
            $this->getParameter('Photo_directory'),
                $fileName
                    );  
     
     $product->setPhotoE($fileName);
     }
     if(!empty($photoF)){
         $fileName = $this->generateUniqueFileName().'.'.$photoF->guessExtension();
            $photoF->move(
            $this->getParameter('Photo_directory'),
                $fileName
                    );         
     $product->setPhotoF($fileName);
     }
     if(!empty($category )){
            $product-> setCategory($category);
    }
     
      if(!empty($pretPornire )){
            $product-> setPretPornire($pretPornire);
    }
     if(!empty($dataStop )){
//          $pretLicitat= $request->request->get('pretLicitat'); 
//             $dataPret = date("Y-m-d H:i:s");
//             $dataPretLicitat = new \DateTime($dataPret);
             $dataStop1 =new \DateTime($dataStop);
            $product-> setDataStop($dataStop1);
    }
 

          $em = $this->getDoctrine()->getManager();
          $em->persist($product);
          $em->flush();

            return $this->render('product/edit.html.twig',
                    [
                       'product'=>$product,
                    
                    
                    ]);
//
          return $this->redirectToRoute('my_products');
        }
//
//    
 
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
