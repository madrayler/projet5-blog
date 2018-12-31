<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminConnectController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_connect_login")
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function login(AuthenticationUtils $authenticationUtils)
	{
		$error =$authenticationUtils->getLastAuthenticationError();
		$lasUsername = $authenticationUtils->getLastUsername();

		return $this->render('admin/admin_connect/login.html.twig', [
			'last_username' => $lasUsername,
			'error' => $error]);
	}

	/**
	* @Route("/admin/logout", name="admin_connect_logout")
	* @IsGranted("ROLE_ADMIN")
	*/
	public function logout()
	{
		
	}

}
