<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 21.05.2016
 * Time: 18:39
 */
class Database
{
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
        $mysqltmp = mysqli_connect($this->host, $this->user, $this->password);
        
        if(!$mysqltmp) {
            throw new Exception('Unable to connect to database. Error:' . mysqli_error($this->databaseLink));
        }

        $this->databaseLink = $mysqltmp;

        if(!mysqli_select_db($this->database, $this->databaseLink)) {

            throw new Exception('Unable to switch to database. Error:' . mysqli_error($this->databaseLink));
        }
    }
}