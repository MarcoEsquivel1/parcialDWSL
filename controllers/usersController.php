<?php
    class UsersController{
        private $model;
        public function __construct()
        {
            require_once("models/usersModel.php");
            $this->model = new UsersModel();
        }

        public function index(){
            return ($this->model->index()) ? $this->model->index() : false;
        }
    }
    

?>