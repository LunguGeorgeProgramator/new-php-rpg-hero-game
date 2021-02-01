<?php
namespace GameEngine;

class engine
{
    public $monster;
    public $hero;

    public function __construct()
    {
        $this->hero = $this->hero();
        $this->monster = $this->monster();
    }

    public function hero()
    {
        $build_hero = new PlayerFactory;
        return $build_hero->createPlayer('hero');
    }

    public function monster()
    {
        $build_monster = new PlayerFactory;
        return $build_monster->createPlayer('monster');
    }

    public function figth($hero, $monster, $turn, $turnCounter = 1, $log_pass = '')
    {
        if(empty($log_pass))
            $log_pass = Logger::getInstance();
        $attacker = null;
        $defender = null;
        $stop_battle = false;
        $skill_name = '';
        $lucky_damage_pass = '';
        
        // set turn to atack and defence
        if (empty($turn)) {
            $turn = $this->determinFirstTurnToAttack($hero, $monster, $turn);
        } elseif ($turn['turn'] === 'hero') {
            $turn['turn'] = 'monster';
            $turn['id'] = $monster->getId();
        } else {
            $turn['turn'] = 'hero';
            $turn['id'] = $hero->getId();
        }

        if ($turn['turn'] === 'hero') {
            $attacker = $hero;
            $defender = $monster;
        } else {
            $attacker = $monster;
            $defender = $hero;
        }

        // set damage
        $damage = $attacker->getStrength() - $defender->getDefence(); // Damage = Attacker strength – Defender defence

        // skils encounter
        $skill = $hero->skills();
        if ($skill !== null && $skill['skill_type'] === 'attack' && $attacker->getName() === "Orderus") {
            $oldDamage = $damage;
            $damage = $skill['number_strikes'] * $damage; // 2 strikes results double the damage
            $skill_name = "Orderus activated attack skill '" . $skill['name'] . "' damage increace from ".$oldDamage." To " . $damage ." -> ";
        }

        if ($skill !== null && $skill['skill_type'] === 'defence' && $defender->getName() === "Orderus") {
            $oldDamage = $damage;
            $damage = ($skill['number_strikes'] / 100) * $damage; // 50 percent of damage/ half of the damage, defence skill
            $skill_name = "Orderus activated defence skill '" . $skill['name'] . "' damage reduce from ".$oldDamage." To " . $damage ." -> ";
        }

        if (rand(0, 100) < $defender->getLuck()) { // the defender gets lucky that turn.
            $damage = 0;
            $lucky_damage_pass = ' Luck change to get 0 damage occured. ';
        }

        $defender->setHealth($defender->getHealth() - $damage); // The damage is subtracted from the defender’s health.
     
        if ($defender->getHealth() <= 0) { // stop battle if defender health reaches 0
            $defender->setHealth(0);
            $stop_battle = true;
            $log_pass->Log('Attack from ' . $attacker->getName() . ".  " .$skill_name . $lucky_damage_pass . " Damage inflicted ".$damage." to ".$defender->getName() . " health remaning is ".$defender->getHealth()." </br>");
            $log_pass->Log('Battle finished, winner is ' . $attacker->getName() . ' !!!</br>');
        } else {
            $log_pass->Log('Attack from ' . $attacker->getName() . ".  " .$skill_name . $lucky_damage_pass . " Damage inflicted ".$damage." to ".$defender->getName() . " health remaning is ".$defender->getHealth()." </br>"); // log battle damage and the defender helth
        }

        if ($turnCounter === 20) { // turns reached 20 game over
            $stop_battle = true;
            $winner = ($hero->getHealth() > $monster->getHealth()) ? $hero->getName() : $monster->getName();
            $log_pass->Log("Max number of turns 20 has been reached , winner is " . $winner . "</br>");
        }

        $turnCounter++;

        return [$hero, $monster, $turn, $stop_battle, $turnCounter, $log_pass];
    }

    public function determinFirstTurnToAttack($hero, $monster, $turn)
    { // The first attack

        if ($monster->getSpeed() > $hero->getSpeed()) {
            $turn = ['turn' => 'monster', 'id' => $monster->getId()];
        } elseif ($monster->getSpeed() < $hero->getSpeed()) {
            $turn = ['turn' => 'hero', 'id' => $hero->getId()];
        } elseif ($monster->getSpeed() === $hero->getSpeed()) {
            if ($monster->getLuck() > $hero->getLuck()) {
                $turn = ['turn' => 'monster', 'id' => $monster->getId()];
            } elseif ($monster->getLuck() < $hero->getLuck()) {
                $turn = ['turn' => 'hero', 'id' =>$hero->getId()];
            } elseif ($monster->getLuck() === $hero->getLuck()) {
                $turn = ['turn' => 'hero', 'id' => $hero->getId()];
            }
        }

        return $turn;
    }
}
