<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if($this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->redirectToRoute('product_index');
             
        }
//        pentru a preveni ca un utilizator logat sa aiba acces la registration and login 
//        
//        
         if ($this->getUser()) {
          $this->redirectToRoute('product_index');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

        
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request)
    {
//        $key = '_security.main.target_path';
//         $url = $request->getSession()->get($key);
//         dump($url);
        $request->getSession()->invalidate();
//        return new RedirectResponse($this->urlGenerator->generate('product_index'));
        return new Response('logout');
//       return $this->redirectToRoute('product_index');
//        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
