<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillsProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->getReference('skill_' );

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
