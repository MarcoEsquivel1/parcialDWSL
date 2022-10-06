<?php
    class UsersModel {
        private $db;
        private $users;

        public function __construct(){
            require_once('models/Conn.php');
            $this->db=Conn::Connection();
        }

        public function index(){
            $stament=$this->db->query('SELECT id_user, nombre FROM usuarios');
            return ($stament->execute()) ? $stament->fetchAll() : false;
        }
    }
    
?>