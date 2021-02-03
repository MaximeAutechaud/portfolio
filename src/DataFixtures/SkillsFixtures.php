<?php

namespace App\DataFixtures;

use App\Entity\Skills;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillsFixtures extends Fixture
{
    private const SKILLS = ['PHP', 'Symfony', 'Javascript', 'React', 'API', 'CSS', 'HTML', 'SCRUM', 'Git', 'Python', 'Node', 'Mysql', 'Postgresql', 'Ruby', 'Websocket'];

    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach (self::SKILLS as $skillName) {
            $skill = new Skills();
            $skill->setName($skillName);
            $manager->persist($skill);
            $this->addReference('skill_' . $i, $skill);
            $i++;
        }
        $manager->flush();
    }
}
