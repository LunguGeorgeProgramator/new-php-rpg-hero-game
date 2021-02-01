<?php
namespace GameEngine;
class Logger
{
    private $log;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function Log($str)
    {
        $this->log .= $str;
    }
    public function getLog()
    {
        return $this->log;
    }
    private static $instance = null;
}
