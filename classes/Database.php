<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 21.05.2016
 * Time: 18:39
 */
class Database
{
    /**
     * @var mysqli
     */
    public $databaseLink;
    private $hasSetConnectionInfo = false;
    public $user;
    public $host;
    public $password;
    public $database;
    
    public function __construct()
    {
        
    }

    public function setServerInformation($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->hasSetConnectionInfo = true;

    }

    public function connectToDatabase() {
        if(!$this->hasSetConnectionInfo) {
            throw new Exception("server Informations hasnt been set");
        }
        $mysqltmp = new mysqli($this->host, $this->user, $this->password, $this->database);
        if(!$mysqltmp) {
            throw new Exception('Unable to connect to database. Error:' . mysqli_error($mysqltmp));
        }
        $this->databaseLink = $mysqltmp;
        $this->databaseLink->set_charset("UTF8");
    }
}