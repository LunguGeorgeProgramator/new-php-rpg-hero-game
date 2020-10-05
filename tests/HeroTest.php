<?php

include_once 'class/hero.php';
include_once 'class/heroBuild.php';

use PHPUnit\Framework\TestCase;

final class HeroTest extends TestCase
{
    private function populateHero(){
        $hero = new Hero();
        $hero->setId(1);
        $hero->setLevel(2);
        $hero->setExperience(333);
        $hero->setName('XXXX');
        $hero->setHealth(12);
        $hero->setStrength(32);
        $hero->setDefence(54);
        $hero->setSpeed(23);
        $hero->setLuck(1);
        return $hero;
    }

    public function testHero()
    {
        $hero = $this->populateHero();
        
        $this->assertInstanceOf(Hero::class, $hero);

        $this->assertSame($hero->getId(), 1);
        $this->assertSame($hero->getLevel(), 2);
        $this->assertSame($hero->getExperience(), 333);
        $this->assertSame($hero->getName(), 'XXXX');
        $this->assertSame($hero->getHealth(), 12);
        $this->assertSame($hero->getStrength(), 32);
        $this->assertSame($hero->getDefence(), 54);
        $this->assertSame($hero->getSpeed(), 23);
        $this->assertSame($hero->getLuck(), 1);
        $this->assertNotEmpty($hero);
    }
    
    public function testHeroUpdate()
    {
        $hero = $this->populateHero();
        $hero->setName('YYY');  
        $hero->setLevel(5); 

        $this->assertSame($hero->getLevel(), 5);
        $this->assertSame($hero->getName(), 'YYY');
    }

}