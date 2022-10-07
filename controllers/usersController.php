<?php
    class UsersController{
        private $model;
        public function __construct()
        {
            require_once("../models/usersModel.php");
            $this->model = new UsersModel();
        }

        public function index(){
            return ($this->model->index()) ? $this->model->index() : false;
        }

        public function add($nombre, $correo, $password, $direccion=""){
            $nom = stripcslashes($nombre);
            $nom = pg_escape_string($nom);
            $corr = stripcslashes($correo);
            $corr = pg_escape_string($corr);
            $pass = stripcslashes($password);
            $pass = pg_escape_string($pass);
            $dire = stripcslashes($direccion);
            $dire = pg_escape_string($dire);
            $id = $this->model->insert($nom, $corr, $pass, $dire);
            return ($id!=false) ? header("Location:../views/index.php") : header("Location:../views/crearUsuario.php");
        }

        public function show($id){
            return ($this->model->show($id) != false) ? $this->model->show($id) : header("Location:../views/index.php");
        }

        public function update($id, $nombre, $correo, $password, $direccion=""){
            $nom = stripcslashes($nombre);
            $nom = pg_escape_string($nom);
            $corr = stripcslashes($correo);
            $corr = pg_escape_string($corr);
            $pass = stripcslashes($password);
            $pass = pg_escape_string($pass);
            $dire = stripcslashes($direccion);
            $dire = pg_escape_string($dire);
            return ($this->model->update($id,$nom, $corr, $pass, $dire) != false) ? header("Location:../views/index.php") : header("Location:../views/updateUsuario.php?id=".$id);
        }

        public function delete($id){
            return ($this->model->delete($id)) ? header("Location:../views/index.php") : header("Location:../views/index.php") ;
        }
    }
    

?>