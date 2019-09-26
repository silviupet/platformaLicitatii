<?php

namespace App\Controller;

use App\Entity\Produsefavorite;
use App\Repository\ProdusefavoriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Entity\User;

class FavoritesController extends AbstractController
{
    /**
     * @Route("/favorites", name="favorites")
     */
    public function index()
    {
        if(!$this->isGranted("IS_AUTHENTICATED_FULLY")) {

            $this->addFlash(
                'warning',
                'Trebuie sa fi logat pentru a vedea produsele tale favorite '
            );
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);



        $userId= $this->getUser()->getUserId();

      $products= $this->getDoctrine()->getManager()


            ->createQuery('select p. productTitle, p.productDescription, p.photoA, p.category, p.pretPornire, p.dataStop, p.ultimulPretLicitat, pf.productId, pf.userId from App\Entity\Product p
                  join App\Entity\Produsefavorite pf
                       where p.productId = pf.productId
                  and pf.userId = :userId')->setParameter('userId',$userId)
            ->getResult();

        $userEmail = $this->getUser()->getEmail();
        return $this->render('favorites/index.html.twig', [
            'products' => $products,
            'user'=> $userEmail,
            'message' => ''
        ]);
    }

    /**
     * @Route("addfavorites", name="addFavorites", methods={"GET", "POST"}, requirements={"productId":"\d+"})
     * @param Request $request
     */
    public function addFavorites(Request $request):Response
    {
        if(!  $this->isGranted("IS_AUTHENTICATED_FULLY")) {

            $this->addFlash(
                'warning',
                'Trebuie sa fi logat pentru a adauga produsele tale favorite '
            );
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);

        $productId = $request->query->get('productId');
        $userId = $this->getUser()->GetUserId();
        $favorites = new Produsefavorite($userId,$productId);
        $repo = $this->getDoctrine()->getRepository(Produsefavorite::Class);
        $produsFavorit=$repo ->findOneBy([
            'productId' => $productId,
            'userId' => $userId
        ]);

        if(!$produsFavorit) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($favorites);
            $entityManager->flush();
            $this->addFlash('success', "produs adaugat la favorite ");
          return $this->redirectToRoute('favorites');
        }
        $this->addFlash('warning', "produs este deja in favorite ");
        return $this->redirectToRoute('favorites');

    }

    /**
     * @Route("/deletefavorite/{productId}", name="favorite_delete", methods={"DELETE"}, requirements={"productId":"\d+"})
     * @param $productId
     */
    public function deleteFromFavorites($productId)
    {


        $this->denyAccessUnlessGranted(['ROLE_USER']);
        $userId= $this->getUser()->getUserId();
        $repo =$this->getDoctrine()->getRepository(Produsefavorite::class);
        $product = $repo->findOneBy([
            'productId'=>$productId,
            'userId'=>$userId
        ]);
      if(!empty($product)) {
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($product);
          $entityManager->flush();
      }
        $this->addFlash('success', 'sters din favorite');
        return $this->redirectToRoute('favorites');
    }

}