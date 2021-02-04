<?php

namespace App\DataFixtures;

use App\Entity\Skills;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SkillsFixtures extends Fixture implements OrderedFixtureInterface
{
    public const SKILLS = ['PHP', 'Symfony', 'Javascript', 'React', 'API', 'CSS', 'HTML', 'SCRUM', 'Git', 'Python', 'Node', 'Mysql', 'Postgresql', 'Ruby', 'Websocket'];

    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::SKILLS as $skillName) {
            $skill = new Skills();
            $skill->setName($skillName);
            $manager->persist($skill);
            $this->addReference('skill_' . $skillName, $skill);
        }
        $manager->flush();
    }
}
