<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setName('Projet random');
        $project->setDescription('C\'était vraiment cool ce projet lol');
        $project->setUrl('www.google.com');
        $project->setPhoto('https://www.google.fr/images/branding/googlelogo/2x/googlelogo_color_160x56dp.png');

        $manager->persist($project);
        $manager->flush();
    }
}
