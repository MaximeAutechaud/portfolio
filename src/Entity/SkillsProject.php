<?php

namespace App\Entity;

use App\Repository\SkillsProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsProjectRepository::class)
 */
class SkillsProject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Skills::class, inversedBy="skillsProjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="skillsProjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkills(): ?Skills
    {
        return $this->skills;
    }

    public function setSkills(?Skills $skills): self
    {
        $this->Skills = $skills;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
