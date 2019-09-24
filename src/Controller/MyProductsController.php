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
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;





class MyProductsController extends AbstractController
{
    /**
     * @Route("/myproducts", name="my_products")
     */
    public function index(ProductRepository $productRepository): Response
    {
        if (!$this->isGranted("IS_AUTHENTICATED_FULLY")) {

            $this->addFlash(
                'warning',
                'Trebuie sa fi logat pentru a vedea produsele tale'
            );
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);

        $userEmail = $this->getUser();

        if ($userEmail == null) {
            return $this->render('my_products/index.html.twig', [
                'products' => $productRepository->findBy([
//                'userId' => $this->getUser()->getUserId()
                ]),
//          'user' => $userEmail->getEmail(),
                'message' => ''

            ]);
        } else
            return $this->render('my_products/index.html.twig', [
                'products' => $productRepository->findBy([
                    'userId' => $this->getUser()->getUserId()
                ]),
                'user' => $userEmail->getEmail(),
                'message' => ''

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
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash(
                'warning',
                'Trebuie sa fi autentificat sa modifici produse'
            );
        }


        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->findOneBy([
           'productId' => $product->getProductId()
        ]);
//    $productId = $request->request->get('productId');
        $productTitle = $request->request->get('productTitle');
        if (!empty($productTitle)) {
            $product->setProductTitle($productTitle);
        }

        $productDescription = $request->request->get('productDescription');
        if (!empty($productDescription)) {
            $product->setProductDescription($productDescription);
        }
        $photoA = $request->files->get('photoA');


//        $allowed_image_extension =[
//            "png",
//            "jpg",
//            "jpeg",
//            "tiff"
//
//        ];
//
//        if($photoA->getMimeType()== in_array($photoA->guessExtension(), $allowed_image_extension))


        $oldFileName = $product->getPhotoA();
        if (!empty($photoA)) {
            if ($this->validatePhoto($photoA)) {
                $fileName = $this->generateUniqueFileName() . '.' . $photoA->guessExtension();
                $photoA->move(
                    $this->getParameter('Photo_directory'),
                    $fileName
                );
                $product->setPhotoA($fileName);
                $this->removePhoto($oldFileName);
            }
        }

//        else return new Response('error');
        $photoB = $request->files->get('photoB');
        $oldFileName = $product->getPhotoB();
        if (!empty($photoB)) {
            if ($this->validatePhoto($photoB)) {
                $fileName = $this->generateUniqueFileName() . '.' . $photoB->guessExtension();
                $photoB->move(
                    $this->getParameter('Photo_directory'),
                    $fileName
                );
                $product->setPhotoB($fileName);
                $this->removePhoto($oldFileName);
            }
        }
        $photoC = $request->files->get('photoC');
        $oldFileName = $product->getPhotoC();
        if (!empty($photoC)) {
            if ($this->validatePhoto($photoC)) {
                $fileName = $this->generateUniqueFileName() . '.' . $photoC->guessExtension();
                $photoC->move(
                    $this->getParameter('Photo_directory'),
                    $fileName
                );
                $product->setPhotoC($fileName);
                $this->removePhoto($oldFileName);
            }
        }
        $photoD = $request->files->get('photoD');
        $oldFileName = $product->getPhotoD();
        if (!empty($photoD)) {
            if ($this->validatePhoto($photoD)) {
                $fileName = $this->generateUniqueFileName() . '.' . $photoD->guessExtension();
                $photoD->move(
                    $this->getParameter('Photo_directory'),
                    $fileName
                );
                $product->setPhotoD($fileName);
                $this->removePhoto($oldFileName);
            }
        }

        $photoE = $request->files->get('photoE');
        $oldFileName = $product->getPhotoE();
        if (!empty($photoE)) {
            if ($this->validatePhoto($photoE)) {
                $fileName = $this->generateUniqueFileName() . '.' . $photoE->guessExtension();
                $photoE->move(
                    $this->getParameter('Photo_directory'),
                    $fileName
                );
                $product->setPhotoE($fileName);
                $this->removePhoto($oldFileName);
            }
        }
        $photoF = $request->files->get('photoF');
        $oldFileName = $product->getPhotoF();
        if (!empty($photoF)) {
            if ($this->validatePhoto($photoA)) {
                $fileName = $this->generateUniqueFileName() . '.' . $photoF->guessExtension();
                $photoF->move(
                    $this->getParameter('Photo_directory'),
                    $fileName
                );
                $product->setPhotoF($fileName);
                $this->removePhoto($oldFileName);
            }
        }
        $category = $request->request->get('category');
        if (!empty($category)) {
            $product->setCategory($category);
        }

        $pretPornire = $request->request->get('pretPornire');
        if (!empty($pretPornire)) {
            if ($this->validatePretPornire($pretPornire)) {

                $product->setPretPornire($pretPornire);
            }
        }
        $dataStop = $request->request->get('dataStop');
        if (!empty($dataStop)) {
            //
            $dataStop1 = new \DateTime($dataStop);
            $product->setDataStop($dataStop1);
        }

//
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
//        $this->addFlash('success', 'produs schimbat');

        return $this->render('product/edit.html.twig',
            [
                'product' => $product,
                'user' => $this->getUser()->getEmail()

            ]);





    }
//        public function uploadPhoto($photo)
//        {
//
//                $fileName = $this->generateUniqueFileName() . '.' . $photo->guessExtension();
//                $photo->move(
//                    $this->getParameter('Photo_directory'),
//                    $fileName
//                );

//            $product ->set'$photo'($fileName);


//        }

    public function removePhoto($oldFileName)
    {

        if ($oldFileName) {
            $oldFilePath = $this->getParameter('Photo_directory') . '/' . $oldFileName;
            if (file_exists($oldFilePath))
                unlink($oldFilePath);
        }
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


//    /**
//     * @Route("/{productId}", name="product_delete", methods={"DELETE"}, requirements={"productId":"\d+"})
//     */
//    public function delete(Request $request, Product $product): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$product->getProductId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($product);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('product_index');
//    }
    public function validatePhoto($photo)
    {
        $allowed_image_extension = [
            "png",
            "jpg",
            "jpeg",
            "tiff"

        ];
        $fileinfo = $photo->getSize();

        if (!$photo->getMimeType() == in_array($photo->guessExtension(), $allowed_image_extension)) {
            $this->addFlash('warning', 'Foto trebuie sa fie de format png, jpg, jpeg, tiff. Produsul nu a fost modificat');
            return false;

            $this->redirectToRoute('product_edit');
        } elseif (!$fileinfo > 2000000) {
            $this->addFlash('warning', 'Dimensiunea foto prea mare. Produsul nu a fost modificat');
            return false;
            $this->redirectToRoute('product_edit');

        } else {
//            $this->addFlash('success', 'produs schimbat');
            return true;

            $this->redirectToRoute('product_edit');
        }


    }

    public function validatePretPornire($pretPornire)
    {
        if (!is_numeric($pretPornire)) {
            $this->addFlash('warning', 'suma licitata trebuie sa sie un numar intreg. Produsul nu a fost modificat');
            return false;
            $this->redirectToRoute('product_edit');
        } else {


            return true;


                $this->redirectToRoute('product_edit');
            }
        }
    }


