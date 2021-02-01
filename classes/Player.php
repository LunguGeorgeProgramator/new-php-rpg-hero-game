<?php
namespace GameEngine;
class Player
{
    private $id;
    private $level;
    private $experience;
    private $name;
    private $health;
    private $strength;
    private $defence;
    private $speed;
    private $luck;
    private $stats;

    public function getId()
    {
        return $this->id;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getDefence()
    {
        return $this->defence;
    }
    
    public function getSpeed()
    {
        return $this->speed;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function getStats()
    {
        return $this->stats;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function setStats($stats)
    {
        $this->stats = $stats;
    }
}
