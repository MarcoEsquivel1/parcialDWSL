<?php
    class UsersController{
        private $model;
        private $pdf;
        
        public function __construct()
        {
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\\parcialDWSL\\models\\usersModel.php');
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\\parcialDWSL\\models\\pdf.php');
            
            /* require_once("../models/usersModel.php"); */
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
            return ($id!=false) ? header("Location:../views/index.php") : false;
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

        public function auth($correo, $password){
            $corr = stripcslashes($correo);
            $corr = pg_escape_string($corr);
            $pass = stripcslashes($password);
            $pass = pg_escape_string($pass);
            return ($this->model->auth($corr, $pass) != false) ? $this->model->show($this->model->auth($corr, $pass)) : 0 ;
        }

        public function genPDF($rows){
            ob_start();
            $this->pdf = new PDF();

            $this->pdf->AliasNbPages();
            $this->pdf->SetAutoPageBreak(true, 10);
            $this->pdf->AddPage('L', 'Letter');
            $this->pdf->SetTitle(utf8_decode("Reporte Usuarios"));
            $this->pdf->SetFont('times', '', 11);

            $header=["Nº usuario","Nombre","Correo","Fecha de alta","Direccion"];
            $data=array();
            for ($i=0; $i < count($rows); $i++) { 
                $data[$i]=array($rows[$i]['id_user'],$rows[$i]['nombre'],$rows[$i]['correo'],$rows[$i]['fecha_alt'],$rows[$i]['direccion']);
            }

            $this->pdf->createTable($header,$data);
            $this->pdf->Output('', 'ReporteUsuarios.pdf');
            ob_end_flush(); 
        }

    }
    

?>