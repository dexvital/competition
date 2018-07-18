<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupTeamRepository")
 */
class GroupTeam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
//
//    /**
//     * @ORM\Column(type="integer")
//     */
//    private $group_id;
//
//    /**
//     * @ORM\Column(type="integer")
//     */
//    private $team_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="groupTeam")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="groupTeam")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    public function getId()
    {
        return $this->id;
    }

//    public function getGroupId(): ?int
//    {
//        return $this->group_id;
//    }
//
//    public function setGroupId(int $group_id): self
//    {
//        $this->group_id = $group_id;
//
//        return $this;
//    }
//
//    public function getTeamId(): ?int
//    {
//        return $this->team_id;
//    }
//
//    public function setTeamId(int $team_id): self
//    {
//        $this->team_id = $team_id;
//
//        return $this;
//    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param $group
     * @return GroupTeam
     */
    public function setGroup($group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param $team
     * @return GroupTeam
     */
    public function setTeam($team): self
    {
        $this->team = $team;

        return $this;
    }
}
