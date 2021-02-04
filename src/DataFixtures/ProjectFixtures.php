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
        return 3;
    }

    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setName(self::PROJECT_REFERENCE);
        $project->setDescription('C\'était vraiment cool ce projet lol');
        $project->setUrl('www.google.com');
        $project->setPhoto('https://www.google.fr/images/branding/googlelogo/2x/googlelogo_color_160x56dp.png');
        $project->setUser($this->getReference('user'));
        for ($i=0; $i > 5;$i++) {
            $skills = $project->addSkill($this->getReference('skill_' . SkillsFixtures::SKILLS[rand(0, sizeof(SkillsFixtures::SKILLS) - 1)]));
            $manager->persist($skills);
        }
        $manager->persist($project);
        $manager->flush();
    }
}
