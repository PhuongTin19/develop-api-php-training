<?php
require_once "Config/ConfigurationLoader.php";

class DataBase {
    private $usernameDB;
    private $serverDB;
    private $passwordDB;
    private $nameDB;
    private $connection;

    /**
     * コンストラクタ.
     * 
     */
    function __construct() {
        $configurationLoader = new ConfigurationLoader(
                "Resource/application.ini");
        $dBconfiguation = $configurationLoader->getDataBaseConfig();
        $this->usernameDB = $dBconfiguation["USERNAME_DB"];
        $this->serverDB = $dBconfiguation["SERVER_DB"];
        $this->passwordDB = $dBconfiguation["PASSWORD_DB"];
        $this->nameDB = $dBconfiguation["NAME_DB"];
    }

    /**
     * Hàm trả về connection đến database.
     * 
     * @return mysqli connection đến database
     */
    function getConnection() {
        $this->connection = new mysqli($this->serverDB, $this->usernameDB,
                $this->passwordDB, $this->nameDB);
        if ($this->connection->connect_error) {
            die("Connect fail:  " . $this->connection->connect_error);
        }
        return $this->connection;
    }

    /**
     * Hàm để ngắt connection đến database.
     * 
     */
    function closeConnection() {
        if ($connection != null) {
            mysqli_close($this->connection);
            $this->connection = null;
        }
    }
}
?>