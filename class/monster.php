<?php
class Monster
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

    function __construct($id, $level, $experience, $name, $health, $strength, $defence, $speed, $luck) {
        $this->id = $id;
        $this->level = $level;
        $this->experience = $experience;
        $this->name = $name;
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
    }

    function setId($id){
        $this->id = $id;
    }

    function setLevel($level){
        $this->level = $level;
    }

    function setExperience($experience){
        $this->experience = $experience;
    }

    function setName($name){
        $this->name = $name;
    }

    function setHealth($health){
        $this->health = $health;
    }

    function setStrength($strength){
        $this->strength = $strength;
    }

    function setDefence($defence){
        $this->defence = $defence;
    }

    function setSpeed($speed){
        $this->speed = $speed;
    }

    function setLuck($luck){
        $this->luck = $luck;
    }

    function getId(){
        return $this->id;
    }

    function getLevel(){
        return $this->level;
    }

    function getExperience(){
        return $this->experience;
    }

    function getName(){
        return $this->name;
    }

    function getHealth(){
        return $this->health;
    }

    function getStrength(){
        return $this->strength;
    }

    function getDefence(){
        return $this->defence;
    }
    
    function getSpeed(){
        return $this->speed;
    }

    function getLuck(){
        return $this->luck;
    }

    function getStats(){
        return $this->stats;
    }

    function setStats($stats){
        $this->stats = $stats;
    }

}
?>