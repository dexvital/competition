<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FightRepository")
 */
class Fight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $group_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $team1_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $team2_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $team1_result;

    /**
     * @ORM\Column(type="integer")
     */
    private $team2_result;

    public function getId()
    {
        return $this->id;
    }

    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): self
    {
        $this->group_id = $group_id;

        return $this;
    }

    public function getTeam1Id(): ?int
    {
        return $this->team1_id;
    }

    public function setTeam1Id(int $team1_id): self
    {
        $this->team1_id = $team1_id;

        return $this;
    }

    public function getTeam2Id(): ?int
    {
        return $this->team2_id;
    }

    public function setTeam2Id(int $team2_id): self
    {
        $this->team2_id = $team2_id;

        return $this;
    }

    public function getTeam1Result(): ?int
    {
        return $this->team1_result;
    }

    public function setTeam1Result(int $team1_result): self
    {
        $this->team1_result = $team1_result;

        return $this;
    }

    public function getTeam2Result(): ?int
    {
        return $this->team2_result;
    }

    public function setTeam2Result(int $team2_result): self
    {
        $this->team2_result = $team2_result;

        return $this;
    }
}
