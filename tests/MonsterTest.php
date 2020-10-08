<?php

include_once 'class/player.php';
include_once 'class/monster.php';

use PHPUnit\Framework\TestCase;

final class MonsterTest extends TestCase
{

    private function populateMonster(){
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

    function testMonster()
    {
        $monster = $this->populateMonster();

        $this->assertInstanceOf(Monster::class, $monster);

        $this->assertSame($monster->getId(), 1);
        $this->assertSame($monster->getLevel(), 2);
        $this->assertSame($monster->getExperience(), 333);
        $this->assertSame($monster->getName(), 'ttt');
        $this->assertSame($monster->getHealth(), 12);
        $this->assertSame($monster->getStrength(), 32);
        $this->assertSame($monster->getDefence(), 54);
        $this->assertSame($monster->getSpeed(), 23);
        $this->assertSame($monster->getLuck(), 1);
        $this->assertNotEmpty($monster);
    }
    
    function testMonsterUpdate()
    {
        $monster = $this->populateMonster();
        $monster->setName('BUC');  
        $monster->setLevel(5); 

        $this->assertSame($monster->getLevel(), 5);
        $this->assertSame($monster->getName(), 'BUC');
    }

}