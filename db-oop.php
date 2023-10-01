<?php

class DB
{
    private $dsn;
    public $pdo;

    function __construct($hostName, $dbName, $userName, $password)
    {
        $this->dsn    = "mysql:host=$hostName;dbname=$dbName";
        try {
            $this->pdo  = new PDO($this->dsn, $userName, $password);
        } catch (PDOException $e) {
            echo "connection failed " . $e->getMessage();
        }
    }

    // get items or specific
    function get_from_db($tableName, $condition = 1)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE $condition;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //delete from db
    function delete_from_db($tableName, $condition)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $tableName WHERE $condition ");
        $stmt->execute();
    }
    //update to db
    function update_from_db($tableName, $condition, $fname, $lname, $email, $phone, $pass)
    {
        $stmt = $this->pdo->prepare("UPDATE $tableName SET fname = ?, lname = ?, email = ? ,
                                phone = ?, pass = ? WHERE $condition;");
        $stmt->execute([$fname, $lname, $email, $phone, $pass]);
    }
    //insert into db
    function insert_into_db($tableName, $data)
    {
        $fields = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        $values = array_values($data);

        $stmt = $this->pdo->prepare("INSERT INTO $tableName ($fields) VALUES ($placeholders)");
        $stmt->execute($values);
    }
}
