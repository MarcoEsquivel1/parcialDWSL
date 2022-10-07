<?php
    class UsersModel {
        private $db;
        private $users;

        public function __construct(){
            require_once('Conn.php');
            $this->db=Conn::Connection();
        }

        public function index(){
            $stament=$this->db->query('SELECT id_user, nombre, correo, fecha_alt, direccion FROM usuarios');
            return ($stament->execute()) ? $stament->fetchAll() : false;
        }

        public function insert($nombre, $correo, $password, $direccion){
            date_default_timezone_set('America/El_Salvador');
            $date = date("Y-m-d", time());
            $id=2;
            $stament = $this->db->prepare("INSERT INTO usuarios (nombre, correo, password, direccion, fecha_alt, id_rol) VALUES (:nombre , :correo, :password, :direccion, :fecha_alt, :id_rol)");
            $stament->bindParam(":nombre",$nombre);
            $stament->bindParam(":correo",$correo);
            $stament->bindParam(":password",$password);
            $stament->bindParam(":direccion",$direccion);
            $stament->bindParam(":fecha_alt",$date);
            $stament->bindParam(":id_rol",$id);$
            return ($stament->execute()) ? $this->db->lastInsertId() : false ;
        }

        public function show($id){
            $stament = $this->db->prepare("SELECT id_user, nombre, correo,  password, direccion, id_rol FROM usuarios where id_user = :id limit 1");
            $stament->bindParam(":id",$id);
            return ($stament->execute()) ? $stament->fetch() : false ;
        }

        public function update($id, $nombre, $correo, $password, $direccion){
            $stament = $this->db->prepare("UPDATE usuarios SET nombre = :nombre, correo = :correo, password = :password, direccion = :direccion WHERE id_user = :id");
            $stament->bindParam(":nombre",$nombre);
            $stament->bindParam(":correo",$correo);
            $stament->bindParam(":password",$password);
            $stament->bindParam(":direccion",$direccion);
            $stament->bindParam(":id",$id);
            return ($stament->execute()) ? $id : false;
        }

        public function delete($id){
            $stament = $this->db->prepare("DELETE FROM usuarios WHERE id_user = :id");
            $stament->bindParam(":id",$id);
            return ($stament->execute()) ? true : false;
        }

        public function auth($email, $password){
            $stament = $this->db->prepare("SELECT * FROM usuarios WHERE correo = :correo AND password = :password limit 1");
            $stament->bindParam(":correo",$email);
            $stament->bindParam(":password",$password);
            $can = false;
            if($stament->execute()){
                $obj = $stament->fetch();
                if($obj != false){
                    $id = $obj['id_user'];
                    $can = true;
                }
            }
            return ($can) ? $id : false;
        }
    }
    
?>