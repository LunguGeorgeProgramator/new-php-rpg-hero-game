<?php

include_once 'class/monster.php';

use PHPUnit\Framework\TestCase;

final class MonsterTest extends TestCase
{
    private function populateMonster(){
        return new Monster(1, 2, 333, 'ttt', 12, 32, 54, 23, 1);
    }

    function testHero()
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
    
    function testHeroUpdate()
    {
        $monster = $this->populateMonster();
        $monster->setName('BUC');  
        $monster->setLevel(5); 

        $this->assertSame($monster->getLevel(), 5);
        $this->assertSame($monster->getName(), 'BUC');
    }

}