<?php

include_once 'database.php';
include_once 'hero.php';
include_once 'monster.php';
include_once 'gameEngineClass.php';

use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{

    private function populateHero(){
        return new Hero(1, 2, 333, 'XXXX', 12, 32, 54, 23, 1);
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
        $results = $engine->figth($this->populateHero(), $this->populateMonster(), [], '', 1);
        $this->assertStringContainsString('Damage', $results[4]);

    }
    


    
}