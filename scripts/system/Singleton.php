<?php
namespace App;
 trait Singleton {
    public static $instance;
    public static function Singleton() {
        $arg = func_get_args();
        $arg = array_pop($arg);
        return (!(self::$instance instanceof self)) || !empty($arg) ? self::$instance = new static (...(array) $arg) : self::$instance;
    }
    function __set($name, $value) {
         $this->$name = $value;
    }
}   
?>