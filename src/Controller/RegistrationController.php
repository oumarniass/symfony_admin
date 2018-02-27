<?php
// src/Controller/RegistrationController.php
namespace App\Controller;
 
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
 
class RegistrationController extends Controller
{
    /**
     * @Route("/inscription", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // création du formulaire
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
 
         
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
 
            // Encode le mot de passe
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
 
            // Enregistre le membre en base
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
 
            return $this->redirectToRoute('app');
        }
 
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
