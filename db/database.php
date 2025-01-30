<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " .$this->db->connect_error);
        }
    }

    public function checkLogin($email, $password){
        $query = "SELECT * FROM persona WHERE email=? AND password=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isClient($email){
        $query = "SELECT tipopersona FROM persona WHERE email = ?"
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC)[0]["ruolo"];
        if ($result == "cliente") {
            return true;
        }
        return false;
    }
}
?>