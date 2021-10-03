<?php
class Database {

    // учетные данные базы данных берем из переменных среды, осталные данные из ini-файла 
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    // получаем соединение с БД 
    public function getConnection(){
	    $this->conn = null;
        $this->host = getenv('DB_HOST', true);
        $this->db_name = getenv('DB_NAME', true);
        $this->username = getenv('DB_USERNAME', true);
        $this->password = getenv('DB_PASSWORD', true);

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>