<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements OrderedFixtureInterface
{
    public const PROJECT_REFERENCE = 'Projet random';

    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setName(self::PROJECT_REFERENCE);
        $project->setDescription('C\'était vraiment cool ce projet lol');
        $project->setUrl('www.google.com');
        $project->setPhoto('https://www.google.fr/images/branding/googlelogo/2x/googlelogo_color_160x56dp.png');
        $project->setUser($this->getReference('user'));
        $this->addReference($project->getName(), $project);

        $manager->persist($project);
        $manager->flush();
    }
}
