<?php

class buildMonsterClass extends Monster {

    public function buildMonster($id = 1){
        $db = new DataBase;
        $monster_DB = $db->runQuery(
            'SELECT * FROM monster where id=1'
        );
        $stats_monster = $db->runQuery(
            'SELECT *
             FROM `attributes_max_min` 
             WHERE subject_type="monster" and subject_id='.$monster_DB[0]['id']
        );
        $stats = $this->getDBStats($stats_monster);
        $this->setId($monster_DB[0]['id']);
        $this->setLevel($monster_DB[0]['level']);
        $this->setExperience($monster_DB[0]['experience']);
        $this->setName($monster_DB[0]['name']);
        $this->setHealth($stats['health']);
        $this->setStrength($stats['strength']);
        $this->setDefence($stats['defence']);
        $this->setSpeed($stats['speed']);
        $this->setLuck($stats['luck']);
        $this->setStats($stats_monster);
        return $this;
    }

    public function getDBStats($statsMonster){
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
?>