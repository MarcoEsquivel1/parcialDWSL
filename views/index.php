<?php
    require_once("../views/layout/header.php");
    require_once ("../controllers/usersController.php");
    $obj = new UsersController();
    $rows =  $obj->index();
?>
    <?php
        
        foreach($rows as $registro){
            echo '<h1>'. $registro['id_user']. "-" .$registro['nombre'] . '</br>';
        }

    ?>
<?php
    require_once("../views/layout/footer.php");
?>