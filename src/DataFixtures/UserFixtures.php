<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\Slugify;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{

    private $passwordEncoder;
    private $slugify;

    public function getOrder()
    {
        return 1;
    }

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
        $this->addReference('user', $user);
        //$this->addReference($user->getFirstname() . ' ' . $user->getLastname(), $user);
        $manager->persist($user);
        $manager->flush();
    }
}
