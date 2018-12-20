<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminConnectController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_connect_login")
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
	* @Route("/admin/deconnexion", name="admin_connect_logout")
	*/
	public function logout()
	{
		
	}
}
