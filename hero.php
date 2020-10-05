<?php
class Hero
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

    // function __construct($id, $level, $experience, $name, $health, $strength, $defence, $speed, $luck) {
    //     $this->id = $id;
    //     $this->level = $level;
    //     $this->experience = $experience;
    //     $this->name = $name;
    //     $this->health = $health;
    //     $this->strength = $strength;
    //     $this->defence = $defence;
    //     $this->speed = $speed;
    //     $this->luck = $luck;
    // }

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

    public function getLuck(){
        return $this->luck;
    }

    public function getStats(){
        return $this->stats;
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

    public function setLuck($luck){
        $this->luck = $luck;
    }

    public function setStats($stats){
        $this->stats = $stats;
     }



}

class buildHeroClass extends Hero {

    public function buildHero(){
        $db = new DataBase;
        $heroDB = $db->runQuery('SELECT * FROM hero where id=1');
        $statsHero = $db->runQuery('SELECT * FROM `attributes_max_min` WHERE subject_type="hero" and subject_id='.$heroDB[0]['id']);
        $stats = $this->getDBStats($statsHero);
        $this->setId($heroDB[0]['id']);
        $this->setLevel($heroDB[0]['level']);
        $this->setExperience($heroDB[0]['experience']);
        $this->setName($heroDB[0]['name']);
        $this->setHealth($stats['health']);
        $this->setStrength($stats['strength']);
        $this->setDefence($stats['defence']);
        $this->setSpeed($stats['speed']);
        $this->setLuck($stats['luck']);
        $this->setStats($statsHero);
        return $this;
    }

    public function getDBStats($statsHero){
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