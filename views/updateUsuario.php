<?php
require_once("../views/layout/header.php");
require_once("../controllers/usersController.php");
if(isset($_SESSION['session']) != true || $_SESSION['session'] != true){
    header('location:../index.php');
}elseif(isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] != 1){
    if(isset($_SESSION['id_user']) != true || $_SESSION['id_user'] != $_GET['id']){        
        header('location:index.php');
    }
}
$obj = new UsersController();
$data = $obj->show($_GET['id']);
if (isset($_POST['ok'])) {
    $obj->update($_GET['id'], $_POST['nombre'], $_POST['correo'], $_POST['password'], $_POST['direccion']);
}
?>


<h2>Crear usuario</h2>
<div class="form mb-3">
    <form method="POST" action="" class="was-validated">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nombre" id="nombre" value='<?php echo $data['nombre'] ?>' required>
            <label for="nombre">Nombre de usuario</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="correo" id="correo" value='<?php echo $data['correo'] ?>' required>
            <label for="correo">Correo electronico</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" value='<?php echo $data['password'] ?>' required>
            <label for="password">Contraseña</label>
        </div>
        <div class="form-floating mb-3 ">
            <textarea class="form-control" name="direccion" id="direccion" rows="5"><?php echo $data['direccion'] ?></textarea>
            <label for="direccion">Direccion</label>
        </div>

        <button type="submit" name="ok" class="btn btn-primary">Actualizar</button>
        <a class="btn btn-danger" href="../views/index.php">Cancelar</a>
    </form>
</div>

<?php
require_once("../views/layout/footer.php");
?>