<?php
namespace GameEngine;
class PlayerFactory
{
    public function createPlayer($player, $player_id=1)
    {
        if ($player === "hero") {
            $player_obj = new Hero();
        } elseif ($player === "monster") {
            $player_obj = new Monster();
            $monster_encounter = (new DataBase)->runQuery('SELECT `id` FROM `monster` ORDER BY RAND() LIMIT 0,1;'); // for random id's
            $player_id = $monster_encounter[0]['id'];
        }

        $player_obj = $this->getDBResults($player_obj, $player, $player_id);
        $player_obj = $this->getDBStats($player_obj, $player);

        return $player_obj;
    }

    public function getDBResults($player_obj, $player, $player_id=1)
    {
        $db = new DataBase;

        $player_DB = $db->runQuery(
            'SELECT * FROM '.$player.' where id=' . $player_id
        );

        $player_obj->setId($player_DB[0]['id']);
        $player_obj->setLevel($player_DB[0]['level']);
        $player_obj->setExperience($player_DB[0]['experience']);
        $player_obj->setName($player_DB[0]['name']);

        return $player_obj;
    }

    public function getDBStats($player_obj, $player)
    {
        $db = new DataBase;

        $stats_player = $db->runQuery(
            'SELECT *
             FROM `attributes_max_min` 
             WHERE subject_type="'.$player.'" and subject_id='.$player_obj->getId()
        );

        $stats = [
            'health' => 0,
            'strength' => 0,
            'defence' => 0,
            'speed' => 0,
            'luck' => 0,
        ];

        foreach ($stats_player as $stat) {
            $stats[$stat['subject_attribute']] = rand($stat['min'], $stat['max']);
        }

        $player_obj->setHealth($stats['health']);
        $player_obj->setStrength($stats['strength']);
        $player_obj->setDefence($stats['defence']);
        $player_obj->setSpeed($stats['speed']);
        $player_obj->setLuck($stats['luck']);
        $player_obj->setStats($stats_player);
       
        return $player_obj;
    }
}
