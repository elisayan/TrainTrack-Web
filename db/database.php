<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
}
?>