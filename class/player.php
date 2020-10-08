<?php

class Player {

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

    public function getDBResults($player, $player_id=1){
        
        $db = new DataBase;

        $player_DB = $db->runQuery(
            'SELECT * FROM '.$player.' where id=' . $player_id 
        );

        $this->setId($player_DB[0]['id']);
        $this->setLevel($player_DB[0]['level']);
        $this->setExperience($player_DB[0]['experience']);
        $this->setName($player_DB[0]['name']);

        return $this;
    }

    public function getDBStats($player){

        $db = new DataBase;

        $stats_player = $db->runQuery(
            'SELECT *
             FROM `attributes_max_min` 
             WHERE subject_type="'.$player.'" and subject_id='.$this->getId()
        );

        $stats = [
            'health' => 0,
            'strength' => 0,
            'defence' => 0,
            'speed' => 0,
            'luck' => 0,
        ];

        foreach($stats_player as $stat){
            $stats[$stat['subject_attribute']] = rand($stat['min'], $stat['max']);
        }

        $this->setHealth($stats['health']);
        $this->setStrength($stats['strength']);
        $this->setDefence($stats['defence']);
        $this->setSpeed($stats['speed']);
        $this->setLuck($stats['luck']);
        $this->setStats($stats_player);
       
        return $this;
    }
}
?>