<?php

include_once 'monster.php';

use PHPUnit\Framework\TestCase;

final class MonsterTest extends TestCase
{
    private function populateMonster(){
        return new Monster(1, 2, 333, 'ttt', 12, 32, 54, 23, 1);
    }

    function testHero()
    {
        $hero = $this->populateMonster();
        $this->assertSame($hero->id, 1);
        $this->assertSame($hero->level, 2);
        $this->assertSame($hero->experience, 333);
        $this->assertSame($hero->name, 'ttt');
        $this->assertSame($hero->health, 12);
        $this->assertSame($hero->strength, 32);
        $this->assertSame($hero->defence, 54);
        $this->assertSame($hero->speed, 23);
        $this->assertSame($hero->luck, 1);
        $this->assertNotEmpty($hero);
    }
    
    function testHeroUpdate()
    {
        $hero = $this->populateMonster();
        $hero->setName('BUC');  
        $hero->setLevel(5); 

        $this->assertSame($hero->level, 5);
        $this->assertSame($hero->name, 'BUC');
    }

}