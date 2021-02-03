<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, inversedBy="skills")
     * @ORM\JoinTable()
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=SkillsProject::class, mappedBy="Skills", orphanRemoval=true)
     */
    private $skillsProjects;

    public function __construct()
    {
        $this->project = new ArrayCollection();
        $this->skillsProjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(Project $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        $this->project->removeElement($project);

        return $this;
    }

    /**
     * @return Collection|SkillsProject[]
     */
    public function getSkillsProjects(): Collection
    {
        return $this->skillsProjects;
    }

    public function addSkillsProject(SkillsProject $skillsProject): self
    {
        if (!$this->skillsProjects->contains($skillsProject)) {
            $this->skillsProjects[] = $skillsProject;
            $skillsProject->setSkills($this);
        }

        return $this;
    }

    public function removeSkillsProject(SkillsProject $skillsProject): self
    {
        if ($this->skillsProjects->removeElement($skillsProject)) {
            // set the owning side to null (unless already changed)
            if ($skillsProject->getSkills() === $this) {
                $skillsProject->setSkills(null);
            }
        }

        return $this;
    }
}
