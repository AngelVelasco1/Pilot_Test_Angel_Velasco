<?php
abstract class credentials
{
    protected $host = '127.0.0.1';
    private $user = 'root';
    private $password = 'password';
    protected $dbname = 'campuslands';

    public function __get($name)
    {
        $this->{$name};
    }

}

?>