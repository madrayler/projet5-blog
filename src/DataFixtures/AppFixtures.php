<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
	private $encoder;

	public function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}
    public function load(ObjectManager $manager)
    {
        $adminRole = new Role();
		$adminRole->setTitle('ROLE_ADMIN');
		$manager->persist($adminRole);

		$adminUser = new User();

		$hash = $this->encoder->encodePassword($adminUser, 'bafigoH88');

		$adminUser->setUsername('madrayler')
				  ->setEmail('madrayler@hotmail.fr')
				  ->setPassword($hash)
				  ->addUserRole($adminRole);
		$manager->persist($adminUser);
		$manager->flush();
    }
}
