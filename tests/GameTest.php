<?php

include_once 'class/database.php';
include_once 'class/hero.php';
include_once 'class/heroBuild.php';
include_once 'class/monster.php';
include_once 'class/monsterBuild.php';
include_once 'class/gameEngineClass.php';
include_once 'class/logger.php';

use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{

    private function populateHero(){
        $hero = new Hero();
        $hero->setId(1);
        $hero->setLevel(5);
        $hero->setExperience(333);
        $hero->setName('XXXX');
        $hero->setHealth(12);
        $hero->setStrength(32);
        $hero->setDefence(54);
        $hero->setSpeed(23);
        $hero->setLuck(1);
        return $hero;
    }

    private function populateMonster(){
        return new Monster(1, 5, 243, 'ZZZ', 143, 322, 534, 22, 33);
    }

    function testFirstTurnFunction()
    {
        $engine = new engine;
        $hero = $this->populateHero();
        $monster = $this->populateMonster();
        $result = $engine->determinFirstTurnToAttack($hero, $monster, []);
        
        $this->assertSame($result["turn"], "hero");
        $this->assertNotEmpty($result);
    }

    function testSkillsFunction(){
        $engine = new engine;
        $result = $engine->skills(); // function gives 2 resonses return random array of results or null
        try {
            $this->assertIsArray($result);
        } catch (Exception $e) {
            $this->assertNull($result);
        }
    }

    function testLogsMessages(){
        $engine = new engine;
        $results = $engine->figth($this->populateHero(), $this->populateMonster(), [], 1, Logger::getInstance());
        $this->assertStringContainsString('Damage', $results[5]->getLog());

    }
    


    
}