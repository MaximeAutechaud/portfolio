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
        $user->setPhoto('dummy-profile.jpg');
        $user->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry:\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
        $slug = $this->slugify->slug($user->getFirstname() . '-' . $user->getLastname());
        $user->setSlug($slug);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));
        $user2 = new User();
        $user2->setEmail('raph@test.com');
        $user2->setFirstname('Raphaël');
        $user2->setLastname('Lière');
        $user2->setPhoto('dummy-profile.jpg');
        $user2->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry:\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
        $slug = $this->slugify->slug($user2->getFirstname() . '-' . $user2->getLastname());
        $user2->setSlug($slug);
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'password'
        ));
        $this->addReference('user_1', $user);
        $this->addReference('user_2', $user2);
        $manager->persist($user);
        $manager->persist($user2);
        $manager->flush();
    }
}
