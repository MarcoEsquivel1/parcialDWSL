<?php

    require_once('models/usersModel.php');
    

    $users= new UsersModel();
    $matrizUsers=$users->getUsers();

    require_once('views/usersView.php');

?>