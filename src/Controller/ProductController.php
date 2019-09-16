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
    public function index(Request $request): Response
    {
//     $product = $this->getDoctrine() ->getRepository(Product::Class);
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
        if(!  $this->isGranted("IS_AUTHENTICATED_FULLY")) {

            $this->addFlash(
                'warning',
                'Trebuie sa fi logat pentru a adauga un produs'
            );
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);

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
     * @param Product
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getProductId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $oldFileName = $product->getPhotoA();
            $this->removeFile($oldFileName);

            $oldFileName = $product->getPhotoB();
            $this->removeFile($oldFileName);

            $oldFileName = $product->getPhotoC();
            $this->removeFile($oldFileName);

            $oldFileName = $product->getPhotoD();
            $this->removeFile($oldFileName);

            $oldFileName = $product->getPhotoE();
            $this->removeFile($oldFileName);

            $oldFileName = $product->getPhotoF();
            $this->removeFile($oldFileName);
          $entityManager->remove($product);
           $entityManager->flush();



       return $this->redirectToRoute('product_index');
    }

}

    public function removeFile($oldFileName){

        if ($oldFileName) {
            $oldFilePath = $this->getParameter('Photo_directory') . '/' . $oldFileName;
            if(file_exists($oldFilePath))
                unlink($oldFilePath);
        }
    }
}
