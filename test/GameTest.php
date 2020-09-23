<?php

include 'database.php';
include 'hero.php';
include 'monster.php';
include 'gameEngineClass.php';

use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{

    function populateHero(){
        return new Hero(1, 2, 333, 'XXXX', 12, 32, 54, 23, 1);
    }

    function populateMonster(){
        return new Monster(1, 5, 243, 'ZZZ', 143, 322, 534, 22, 33);
    }

    public function testFirstTurnFunction()
    {
        $engine = new engine;
        $hero = $this->populateHero();
        $monster = $this->populateMonster();
        $result = $engine->determinFirstTurnToAttack($hero, $monster, []);
        
        $this->assertSame($result["turn"], "hero");
        $this->assertNotEmpty($result);
    }
    


    
}