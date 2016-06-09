<?php

/**
 *  @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class Database
{
    /**
     * @var mysqli
     */
    public $databaseLink;
    /**
     * @var bool
     */
    private $hasSetConnectionInfo = false;
    /**
     * @var String
     */
    public $user;
    /**
     * @var String
     */
    public $host;
    /**
     * @var String
     */
    public $password;
    /**
     * @var String
     */
    public $database;

    /**
     * @param $host
     * @param $user
     * @param $password
     * @param $database
     */
    public function setServerInformation($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->hasSetConnectionInfo = true;

    }

    /**
     * @throws Exception
     */
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