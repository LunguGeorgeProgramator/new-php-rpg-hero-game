<?php
class buildHeroClass extends Hero {

    public function buildHero(){
        $db = new DataBase;
        $heroDB = $db->runQuery(
            'SELECT * FROM hero where id=1'
        );
        $statsHero = $db->runQuery(
            'SELECT *
             FROM `attributes_max_min` 
             WHERE subject_type="hero" and subject_id='.$heroDB[0]['id']
        );
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
?>