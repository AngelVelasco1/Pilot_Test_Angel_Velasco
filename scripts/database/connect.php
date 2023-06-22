<?php
interface enviroment {
    public function __get($name);
};
abstract class connect extends credentials implements enviroment {
    use Singleton;

    protected $conx;

    function __construct(private $driver = 'mysql', private $port = '3306') {
        try {
            $this->conx = new PDO($this->driver . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . ';user=' . $this->__get('user') . ';password=' . $this->__get('password'));
            $this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) {
            $this->conx = $e->getMessage();
        }
    }
}

?>