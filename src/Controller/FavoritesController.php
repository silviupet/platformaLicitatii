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
        $this->denyAccessUnlessGranted(['ROLE_USER']);
        $userId= $this->getUser()->getUserId();
//        $repo = $this->getDoctrine()->getRepository(Product::Class);
//        $products = $repo->findBy([
//            'userId' => $userId
//        ]);
//
      $products= $this->getDoctrine()->getManager()
//

            ->createQuery('select p. productTitle, p.productDescription, p.photoA, p.category, p.pretPornire, p.dataStop, p.ultimulPretLicitat, pf.productId, pf.userId from App\Entity\Product p
                  join App\Entity\Produsefavorite pf
                       where p.productId = pf.productId
                  and pf.userId = :userId')->setParameter('userId',$userId)
            ->getResult();
//         dump($products);
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
    public function addFavorites(Request $request)
    {
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
            return new Response('adaugat la favorite');
        }
        return new Response('produsul este deja in favorite');

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
      if(empty(!$product)) {
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($product);
          $entityManager->flush();
      }

        return $this->redirectToRoute('favorites');
    }

}