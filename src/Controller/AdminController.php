<?php

namespace App\Controller;



use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Licitatie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(ProductRepository $productRepository): Response
    {
        if($this->isGranted("IS_AUTHENTICATED_FULLY")&& !$this->isGranted("ROLE_ADMIN")){
            $this->addFlash('warning','Esti deja logat. Trebuie sa te deloghezi pt a accesa meniul de administrator');
            return $this->redirectToRoute('product_index');
        }

        $this->denyAccessUnlessGranted(["ROLE_ADMIN"]);
        



         $userEmail = $this->getUser();
     
       if ($userEmail ==null){
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
//          'user' => $userEmail->getEmail(),
            'message' =>''
       ]);         
       } else 
        return $this->render('product/index.html.twig', [
           'products' => $productRepository->findAll(),
          'user' => $userEmail->getEmail(),
            'message' =>''
     ]);   
       return $this->redirectToRoute('product_index');
//        return $this->render('product/index.html.twig', [
//            'products' => $productRepository->findAll(),
//        ]);
    }

    


}