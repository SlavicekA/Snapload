<?php

class db_context{
    const dsn = "mysql:host=localhost;dbname=snapload";
    const dbusername = "root";
    const dbpassword = "";
    private static $pdo;

    public static function connect(){
        self::$pdo = new PDO(self::dsn,self::dbusername,self::dbpassword);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function select ($columns ,$tablename){
        $query = "SELECT $columns FROM $tablename";

        $stmt = self::$pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function insert($table, $data = []){
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO ($columns) VALUES ($placeholders)";

        $stmt = self::$pdo->prepare($query);

        foreach($data as $column => $value){
            $stmt->bindParam(":" .  $column, $value);
        }

        $stmt->execute();
    }
}