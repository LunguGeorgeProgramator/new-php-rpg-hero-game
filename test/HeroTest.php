<?php

include_once 'hero.php';

use PHPUnit\Framework\TestCase;

final class HeroTest extends TestCase
{
    private function populateHero(){
        return new Hero(1, 2, 333, 'XXXX', 12, 32, 54, 23, 1);
    }

    public function testHero()
    {
        $hero = $this->populateHero();
        
        $this->assertInstanceOf(Hero::class, $hero);

        $this->assertSame($hero->id, 1);
        $this->assertSame($hero->level, 2);
        $this->assertSame($hero->experience, 333);
        $this->assertSame($hero->name, 'XXXX');
        $this->assertSame($hero->health, 12);
        $this->assertSame($hero->strength, 32);
        $this->assertSame($hero->defence, 54);
        $this->assertSame($hero->speed, 23);
        $this->assertSame($hero->luck, 1);
        $this->assertNotEmpty($hero);
    }
    
    public function testHeroUpdate()
    {
        $hero = $this->populateHero();
        $hero->setName('YYY');  
        $hero->setLevel(5); 

        $this->assertSame($hero->level, 5);
        $this->assertSame($hero->name, 'YYY');
    }

}