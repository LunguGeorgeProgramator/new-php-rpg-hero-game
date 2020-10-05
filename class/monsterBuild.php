<?php

class buildMonsterClass {

    public function buildMonster($id = 1){
        $db = new DataBase;
        $monsterDB = $db->runQuery(
            'SELECT * FROM monster where id=' . $id
        );
        $statsMonster = $db->runQuery(
            'SELECT * FROM `attributes_max_min` WHERE subject_type="monster" and subject_id=' . $monsterDB[0]['id']
        );
        $stats = $this->getDBStats($statsMonster);
        $monster = new Monster(
            $monsterDB[0]['id'], 
            $monsterDB[0]['level'], 
            $monsterDB[0]['experience'], 
            $monsterDB[0]['name'], 
            $stats['health'], 
            $stats['strength'], 
            $stats['defence'], 
            $stats['speed'], 
            $stats['luck']
        );
        $monster->setStats($statsMonster);
        return $monster;
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