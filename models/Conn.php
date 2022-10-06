<?php
include('data.php');
class Conn{
    public static function Connection(){
        try{
            $string = "pgsql:host=".SERVER.";port=5433;dbname=".DBNAME.";";
            $Conn = new PDO($string, USER, PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            /* $Conn->exec("SET CHARACTER SET UTF8"); */
            if ($Conn) {
                return $Conn;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        } finally {
            if ($Conn) {
                $Conn = null;
            }
        }
    
    }
}
?>