<?php
namespace App;
abstract class credentials
{
    protected $host = '127.0.0.1';
    private $user = 'root';
    private $password;
    protected $dbname = 'campusland';

    public function __get($name)
    {
        $this->{$name};
    }

}

?>