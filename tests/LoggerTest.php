<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    public function testLogInstance(){
        $log = GameEngine\Logger::getInstance();
        $log->Log('Attack test log set');
        $this->assertStringStartsWith('Attack', $log->getLog());
    }
}
?>