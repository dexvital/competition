<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupsRepository")
 */
class Groups
{
    const TYPE_ALLVSALL = 'AllVsAll';
    const TYPE_FINAL = 'Final';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $competition_id;

    /** @ORM\OneToMany(targetEntity="App\Entity\GroupsTeam", mappedBy="groups") */
    protected $teams;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="groups")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCompetitionId(): ?int
    {
        return $this->competition_id;
    }

    public function setCompetitionId(int $competition_id): self
    {
        $this->competition_id = $competition_id;

        return $this;
    }

    public function getTeams()
    {
        return $this->teams;
    }

    public function setTeams($teams): self
    {
        $this->teams = $teams;

        return $this;
    }

    public function getCompetition()
    {
        return $this->competition;
    }

    public function setCompetition($competition): self
    {
        $this->competition = $competition;

        return $this;
    }


}
