<?php
class Hero
{
    public $id;
    public $level;
    public $experience;
    public $name;
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;

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

    function getLevel(){
        $this->level;
    }


    function getExperience(){
        $this->experience;
    }


    function getName(){
        $this->name;
    }


    function getHealth(){
        $this->health;
    }

    function getStrength(){
        $this->strength;
    }

    function getDefence(){
        $this->defence;
    }
    
    function getSpeed(){
        $this->speed;
    }

    function getLuck(){
        $this->luck;
    }

}

class buildHeroClass {

    public function buildHero(){
        $db = new DataBase;
        $heroDB = $db->runQuery('SELECT * FROM hero where id=1');
        $statsHero = $db->runQuery('SELECT * FROM `attributes_max_min` WHERE subject_type="hero" and subject_id='.$heroDB[0]['id']);
        $stats = $this->getStats($statsHero);
        $hero = new Hero($heroDB[0]['id'], $heroDB[0]['level'], $heroDB[0]['experience'], $heroDB[0]['name'], $stats['health'], $stats['strength'], $stats['defence'], $stats['speed'], $stats['luck']);
        return $hero;
    }

    public function getStats($statsHero){
        $stats = [
            'health' => 0,
            'strength' => 0,
            'defence' => 0,
            'speed' => 0,
            'luck' => 0,
        ];
        foreach($statsHero as $stat){
            $stats[$stat['subject_attribute']] = rand($stat['min'], $stat['max']);
        }
        return $stats;
    }
}