<?php

include_once 'class/database.php';
include_once 'class/player.php';
include_once 'class/hero.php';
include_once 'class/monster.php';
include_once 'class/playerFactory.php';
include_once 'class/gameEngineClass.php';
include_once 'class/logger.php';

use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    private function populateHero()
    {
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

    private function populateMonster()
    {
        $monster = new Monster();
        $monster->setId(1);
        $monster->setLevel(2);
        $monster->setExperience(333);
        $monster->setName('ttt');
        $monster->setHealth(12);
        $monster->setStrength(32);
        $monster->setDefence(54);
        $monster->setSpeed(23);
        $monster->setLuck(1);
        return $monster;
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

    public function testLogsMessages()
    {
        $engine = new engine;
        $results = $engine->figth($this->populateHero(), $this->populateMonster(), [], 1, Logger::getInstance());
        $this->assertStringContainsString('Damage', $results[5]->getLog());
    }
}
