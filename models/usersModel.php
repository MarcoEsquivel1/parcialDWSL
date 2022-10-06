<?php
    class UsersModel {
        private $db;
        private $users;

        public function __construct(){
            require_once('models/Conn.php');
            $this->db=Conn::Connection();
        }

        public function getUsers(){
            $consulta=$this->db->query('SELECT id_user, nombre FROM usuarios');
            while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->users[]=[
                    "id_user" => $filas['id_user'], 
                    "nombre" => $filas['nombre'], 
                ];
            }
            
            return $this->users;
        }
    }
    
?>