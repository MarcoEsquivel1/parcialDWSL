<?php
  require_once("../views/layout/header.php");
  require_once ("../controllers/usersController.php");
  if(isset($_SESSION['session']) != true || $_SESSION['session'] != true){
    header('location:../index.php');
  }elseif(isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] != 1){
    header('location:index.php');
  }
  if (isset($_POST['ok'])) {
    $obj=new UsersController();
    $obj->add($_POST['nombre'], $_POST['correo'], $_POST['password'], $_POST['direccion']);
  }
?>

    <h2>Crear usuario</h2>
    <div class="form mb-3">
        <form method="POST" action="" class="was-validated">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control" name="nombre" id="nombre" placeholder="#" required>
              <label for="nombre">Nombre de usuario</label>
            </div>
            <div class="form-floating mb-3">
              <input
                type="email"
                class="form-control" name="correo" id="correo" placeholder="#" required>
              <label for="correo">Correo electronico</label>
            </div>
            <div class="form-floating mb-3">
              <input
                type="password"
                class="form-control" name="password" id="password" placeholder="#" required>
              <label for="password">Contraseña</label>
            </div>
            <div class="form-floating mb-3 ">
                <textarea class="form-control" name="direccion" id="direccion" rows="5" placeholder="#"></textarea>
              <label for="direccion">Direccion</label>
            </div>

            <button type="submit" name="ok" class="btn btn-primary">Crear</button>
            <a class="btn btn-danger" href="../views/index.php">Cancelar</a>
        </form>
    </div>

<?php
    require_once("../views/layout/footer.php");
?>