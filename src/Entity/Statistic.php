<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 */
class Statistic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Beer::class, inversedBy="statistics")
     */
    private $beer_id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="statistics")
     */
    private $cliend_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeerId(): ?Beer
    {
        return $this->beer_id;
    }

    public function setBeerId(?Beer $beer_id): self
    {
        $this->beer_id = $beer_id;

        return $this;
    }

    public function getCliendId(): ?Client
    {
        return $this->cliend_id;
    }

    public function setCliendId(?Client $cliend_id): self
    {
        $this->cliend_id = $cliend_id;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
