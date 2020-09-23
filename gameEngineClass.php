<?php

class engine{

    public $monster;
    public $hero;

    function __construct(){
        $this->hero = $this->hero();
        $this->monster = $this->monster();
    }

    function hero(){
        $buildHero = new buildHeroClass;
        return $buildHero->buildHero();
    }

    function monster(){
        // $monsterEncounter = (new DataBase)->runQuery('SELECT `id` FROM `monster` ORDER BY RAND() LIMIT 0,1;');
        $monsterEncounter = (new DataBase)->runQuery('SELECT `id` FROM `monster` where id = 1');
        $buildMonster = new buildMonsterClass;
        return $buildMonster->buildMonster($monsterEncounter[0]['id']);
    }

    function figth($hero, $monster, $turn, $log = '', $turnCounter = 1){
        $atacker = null;
        $defender = null;
        $stop_battle = false;
        $skill_name = '';
        $lucky_damage_pass = '';
        
        // set turn to atack and defence
        if(empty($turn)){
            $turn = $this->determinFirstTurnToAttack($hero, $monster, $turn);
        } elseif ($turn['turn'] === 'hero') {
            $turn['turn'] = 'monster';
            $turn['id'] = $monster->id;
        } else {
            $turn['turn'] = 'hero';
            $turn['id'] = $hero->id;
        } 

        if($turn['turn'] === 'hero'){
            $atacker = $hero;
            $defender = $monster;
        } else {
            $atacker = $monster;
            $defender = $hero;
        }

        // set damage
        $damage = $atacker->strength - $defender->defence; // Damage = Attacker strength – Defender defence


        // skils encounter
        $skill = $this->skills();
        if($skill !== null && $skill['skill_type'] === 'attack' && $atacker->name === "Orderus"){
            $oldDamage = $damage;
            $damage = $skill['number_strikes'] * $damage; // 2 strikes results double the damage
            $skill_name = "Orderus activated attack skill '" . $skill['name'] . "' damage increace from ".$oldDamage." To " . $damage ." -> ";
        } 

        if($skill !== null && $skill['skill_type'] === 'defence' && $defender->name === "Orderus"){
            $oldDamage = $damage;
            $damage = ($skill['number_strikes'] / 100) * $damage; // 50 percent of damage/ half of the damage, defence skill
            $skill_name = "Orderus activated defence skill '" . $skill['name'] . "' damage reduce from ".$oldDamage." To " . $damage ." -> ";
        } 

        if(rand(0, 100) < $defender->luck ){ // the defender gets lucky that turn.
            $damage = 0;
            $lucky_damage_pass = ' Luck change to get 0 damage occured. ';
        }

        $defender->setHealth($defender->health - $damage); // The damage is subtracted from the defender’s health.
     
        if($defender->health <= 0) { // stop battle if defender health reaches 0
            $defender->health = 0;
            $stop_battle = true;
            $log .= 'Attack from ' . $atacker->name . ".  " .$skill_name . $lucky_damage_pass . " Damage inflicted ".$damage." to ".$defender->name . " health remaning is ".$defender->health." </br>";
            $log .= 'Battle finished !!!</br>';
        } else {
            $log .= 'Attack from ' . $atacker->name . ".  " .$skill_name . $lucky_damage_pass . " Damage inflicted ".$damage." to ".$defender->name . " health remaning is ".$defender->health." </br>"; // log battle damage and the defender helth
        }

        if($turnCounter === 20) { // turns reached 20 game over
            $stop_battle = true;
            $winner = ($hero->health > $monster->health) ? $hero->name : $monster->name;
            $log .= "Max number of turns 20 has been reached , winner is " . $winner . "</br>";
        }

        $turnCounter++;

        return [$hero, $monster, $turn, $stop_battle, $log, $turnCounter];
    }

    function determinFirstTurnToAttack($hero, $monster, $turn){ // The first attack
        if ($monster->speed > $hero->speed) { 
            $turn = ['turn' => 'monster', 'id' => $monster->id];
        } elseif ($monster->speed < $hero->speed) {
            $turn = ['turn' => 'hero', 'id' => $hero->id];
        } elseif ($monster->speed === $hero->speed) {
            if ($monster->luck > $hero->luck) {
                $turn = ['turn' => 'monster', 'id' => $monster->id];
            } elseif ($monster->luck < $hero->luck) {
                $turn = ['turn' => 'hero', 'id' =>$hero->id];
            } elseif ($monster->luck === $hero->luck) {
                $turn = ['turn' => 'hero', 'id' => $hero->id];
            }
        }
        return $turn;
    }

    function skills(){
        $skills = (new DataBase)->runQuery(
            'SELECT s.* FROM `hero` h
            INNER JOIN heros_skills hs on hs.id_hero = h.id
            inner join skill s on s.id = hs.id_skill
            WHERE h.id = 1'
        );
        foreach($skills as $skill){
            if(rand(0, 100) < $skills[0]['skill_chance']) { // check the chance of the skill to occur
                return $skill;
            }
        }
        return null;
    }


}

?>