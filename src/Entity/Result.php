<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultRepository")
 */
class Result
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
    private $competition_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $group_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $team_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $wins_cnt;

    public function getId()
    {
        return $this->id;
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

    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id): self
    {
        $this->group_id = $group_id;

        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->team_id;
    }

    public function setTeamId(int $team_id): self
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getWinsCnt(): ?int
    {
        return $this->wins_cnt;
    }

    public function setWinsCnt(int $wins_cnt): self
    {
        $this->wins_cnt = $wins_cnt;

        return $this;
    }
}
