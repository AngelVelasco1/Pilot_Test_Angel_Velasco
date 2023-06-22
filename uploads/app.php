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
             $this->$name = $value;
        }
    }
    //? Autoload
    function autoload($class) {
        $directories = array_filter(glob(dirname(__DIR__) . '/scripts/*'), 'is_dir');
    
        $classFile = str_replace('\\', '/', $class) . '.php';
    
        foreach ($directories as $directory) {
            $file = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $classFile;
            if (file_exists($file)) {
                require $file;
                break;
            }
        }
    }

     spl_autoload_register('autoload');

    academicArea::Singleton(json_decode(file_get_contents("php://input"), true));

?>