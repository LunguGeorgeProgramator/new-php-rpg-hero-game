<?php
class Logger {
    private $log;
    static function getInstance()
    {
        if (self::$instance == NULL) {
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
    function Log($str)
    {
        $this->log .= $str;
    }
    public function getLog()
    {
      return $this->log;
    }
    static private $instance = NULL;
}

?>