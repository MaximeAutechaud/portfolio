<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\Slugify;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    private $slugify;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, Slugify $slugify)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('test@test.com');
        $user->setFirstname('Maxime');
        $user->setLastname('Autechaud');
        $user->setDescription('Bonjour c\'est moi Maxime comment ça va ?');
        $slug = $this->slugify->slug($user->getFirstname() . '-' . $user->getLastname());
        $user->setSlug($slug);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));
        $manager->persist($user);
        $manager->flush();
    }
}
