<?php

class DbContext{
    const DSN = "mysql:host=localhost;dbname=snapload";
    const DBUSERNAME = "root";
    const DBPASSWORD = "";
    private static $pdo;

    public static function __construct(){
        self::$pdo = new PDO(self::DSN,self::DBUSERNAME,self::DBPASSWORD);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function select ($columns = [] ,$tableName, $conditions = []){
        $columnsString = implode(",",$columns);

        $query = "SELECT $columnsString FROM $tableName";

        if(!empty($conditions)){
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function insert($table, $data = []){
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = self::$pdo->prepare($query);

        foreach($data as $column => $value){
            $stmt->bindValue(":" .  $column, $value);
        }

        $stmt->execute();
    }
}