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
        $monster = $this->populateMonster();

        $this->assertInstanceOf(Monster::class, $monster);

        $this->assertSame($monster->id, 1);
        $this->assertSame($monster->level, 2);
        $this->assertSame($monster->experience, 333);
        $this->assertSame($monster->name, 'ttt');
        $this->assertSame($monster->health, 12);
        $this->assertSame($monster->strength, 32);
        $this->assertSame($monster->defence, 54);
        $this->assertSame($monster->speed, 23);
        $this->assertSame($monster->luck, 1);
        $this->assertNotEmpty($monster);
    }
    
    function testHeroUpdate()
    {
        $monster = $this->populateMonster();
        $monster->setName('BUC');  
        $monster->setLevel(5); 

        $this->assertSame($monster->level, 5);
        $this->assertSame($monster->name, 'BUC');
    }

}