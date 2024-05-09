<?php
class DB
{
    protected $server = "";
    protected $username = "";
    protected $password = "";
    protected $dbname = "laptoptn";
    public $conn;
    public function __construct()
    {
        try {
            if ($this->conn == null)
                $this->conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);
                $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            die("Không thể kết nối đến Database: $e ");
        }
    }
    public function command($query)
    {
        return $this->conn->query($query);
    }
    public function __destruct()
    {
        $this->conn->close();
    }
}
