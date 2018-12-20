<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnectController extends AbstractController
{
	/**
	* @Route("/inscription", name="connect_registration")
	*/
	public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
	{
		$user = new User();

		$form = $this->createForm(RegistrationType::class, $user);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$hash = $encoder->encodePassword($user, $user->getPassword());
			$user->setPassword($hash);
			
			$manager->persist($user);
			$manager->flush();

			return $this->redirectToRoute('blog');
		}

		return $this->render('connect/connect_pages/registration.html.twig', [
			'form' => $form->createView()]);
	}

	/**
	* @Route("/connexion", name="connect_login")
	*/
	public function login(AuthenticationUtils $authenticationUtils)
	{
		$error =$authenticationUtils->getLastAuthenticationError();
		$lasUsername = $authenticationUtils->getLastUsername();

		return $this->render('connect/connect_pages/login.html.twig', [
			'last_username' => $lasUsername,
			'error' => $error]);
	}

	/**
	* @Route("/deconnexion", name="connect_logout")
	*/
	public function logout()
	{
		
	}
}
