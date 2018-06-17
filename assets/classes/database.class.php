<?php
class Database {
    private $host = '', $dbname = '', $username = '' , $password = '';
    private $pdo = null;
    private static $instance = null;

    public static function ini($host, $dbname, $username, $password) {
        if(self::$instance == null || self::$instance->attrChanged($host, $dbname, $username, $password)) {
            self::$instance = new Database($host, $dbname, $username, $password);
        }

        return self::$instance;
    }

    public function __construct($host, $dbname, $username, $password) {
        $this->pdo = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    private function attrChanged($host, $dbname, $username, $password) {
        return $this->host != $host || $this->dbname != $dbname || $this->username != $username || $this->password != $password;
    }

    public function setFetchMode($fetchMode) {
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $fetchMode);
    }

    /**
     * @param string $query query string.
     * @param array $params array of parameters.
     * @return int
     */
    public function nonQuery($query, $params = []) {
        $stm = $this->pdo->prepare($query);
        $stm = $stm->execute($params);

        $this->lastInsertId = $this->pdo->lastInsertId();
        // $this->pdo->closeCursor();

        return $stm;
    }

    private $lastInsertedId = null;

    public function lastInsertId() {
        return $this->lastInsertId;
    }

    /**
     * @param string $query query string.
     * @param array $params array of parameters.
     * @return mixed array 2D
     */
    public function selectQuery($query, $params = []) {
        $stm = $this->pdo->prepare($query);
        $stm->execute($params);
        $stm = $stm->fetchAll();

        return $stm;
    }

    public function scalarQuery($query, $params = []) {
        $rows = $this->selectQuery($query, $params);

        if(count($rows) === 0) {
            return 0;
        }

        $rows = $rows[0];

        foreach($rows as $key => $value) {
            $result = $value;
        }

        return $result;
    }
}