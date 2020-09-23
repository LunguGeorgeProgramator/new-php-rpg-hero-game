<?php
class Monster
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

class buildMonsterClass {

    public function buildMonster($id = 1){
        $db = new DataBase;
        $monsterDB = $db->runQuery('SELECT * FROM monster where id='.$id);
        $statsMonster = $db->runQuery('SELECT * FROM `attributes_max_min` WHERE subject_type="monster" and subject_id='.$monsterDB[0]['id']);
        $stats = $this->getStats($statsMonster);
        $monster = new Hero($monsterDB[0]['id'], $monsterDB[0]['level'], $monsterDB[0]['experience'], $monsterDB[0]['name'], $stats['health'], $stats['strength'], $stats['defence'], $stats['speed'], $stats['luck']);
        return $monster;
    }

    public function getStats($statsMonster){
        $stats = [
            'health' => 0,
            'strength' => 0,
            'defence' => 0,
            'speed' => 0,
            'luck' => 0,
        ];
        foreach($statsMonster as $stat){
            $stats[$stat['subject_attribute']] = rand($stat['min'], $stat['max']);
        }
        return $stats;
    }
}