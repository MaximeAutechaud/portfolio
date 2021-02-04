<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements OrderedFixtureInterface
{
    public const PROJECTS = [
        'name' => 'Projet random',
        'photo' => 'tilleul-arbre.jpg',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'url' => 'www.google.com',
    ];

    public function getOrder()
    {
        return 3;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10 ; $i++) {
            $project = new Project();
            $project->setName(self::PROJECTS['name']);
            $project->setDescription(self::PROJECTS['description']);
            $project->setUrl(self::PROJECTS['url']);
            $project->setPhotoProject(self::PROJECTS['photo']);
            $project->setUser($this->getReference('user_' . rand(1,2)));
            $manager->persist($project);
        }
        /* for ($i=0; $i > 5;$i++) {
            $skills = $project->addSkill($this->getReference('skill_' . SkillsFixtures::SKILLS[rand(0, sizeof(SkillsFixtures::SKILLS) - 1)]));
            $manager->persist($skills);
        } */
        $manager->flush();
    }
}
