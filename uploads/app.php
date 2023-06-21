<?php
    //? Singleton 
    trait Singleton {
        public static $instance;
        public static function Singleton() {
            $arg = func_get_args();
            $arg = array_pop($arg);
            return (!(self::$instance instanceof self)) || !empty($arg) ? self::$instance = new static (...(array) $arg) : self::$instance;
        }
        function __set($name, $value) {
            return $this->$name = $value;
        }
    }
    //? Autoload
    function autoload($class) {
        $directories = [

        ];
        $classFile = str_replace('\\', '/', $class). '.php';

        foreach ($directories as $directory) {
            $file = $directory . $classFile;
            return (file_exists($file)) ? require $file : false;
        }
    }
    spl_autoload_register('autoload');

?>