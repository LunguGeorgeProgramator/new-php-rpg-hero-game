<?php
include_once 'class/logger.php';

use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    public function testLogInstance(){
        $log = new Logger;
        $this->assertNotNull($log->getLog());
    }
}
?>