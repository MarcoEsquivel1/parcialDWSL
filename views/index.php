<?php
    require_once("../views/layout/header.php");
    require_once("../controllers/usersController.php");
    $obj = new UsersController();
    $rows =  $obj->index();
    /* session_start(); */
    if(isset($_SESSION['session']) != true || $_SESSION['session'] != true){
        header('location:../index.php');
    }
    if (isset($_POST['ok2'])) {
        if(isset($_POST['eliminar'])){
            $deletes = $_POST['eliminar'];
            foreach($deletes as $del){
                $obj->delete($del);
            }
            if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != 1){
                header('location:logout.php');
            }
        }
    }
?>
    <a target="_blank" class="text-success text-decoration-none" href='../views/genPDF.php'><h3>Generar pdf<img class="mx-2" width='32px' src='../public/images/pdf.png'/></h3></a>
<form method="post">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>Nº usuario</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de alta</th>
                <th>Direccion</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($rows as $registro) : ?>
                <tr>
                    <td>
                        <?php if((isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] != 1) &&
                                            (isset($_SESSION['id_user']) != true || $_SESSION['id_user'] != $registro['id_user'])):?> 
                            <input disabled type=checkbox name='eliminar[]' value='<?php echo $registro['id_user'] ?>' title='<?php echo $registro['id_user'] ?>'>
                        <?php elseif((isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] != 1) &&
                                            (isset($_SESSION['id_user']) != true || $_SESSION['id_user'] == $registro['id_user'])): ?>
                            <input  type=checkbox name='eliminar[]' value='<?php echo $registro['id_user'] ?>' title='<?php echo $registro['id_user'] ?>'>  
                        <?php endif ?>
                        <?php if((isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] == 1) &&
                                            (isset($_SESSION['id_user']) != true || $_SESSION['id_user'] == $registro['id_user'])):?> 
                            <input disabled type=checkbox name='eliminar[]' value='<?php echo $registro['id_user'] ?>' title='<?php echo $registro['id_user'] ?>'>
                        <?php elseif((isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] == 1) &&
                                            (isset($_SESSION['id_user']) != true || $_SESSION['id_user'] != $registro['id_user'])): ?>
                            <input  type=checkbox name='eliminar[]' value='<?php echo $registro['id_user'] ?>' title='<?php echo $registro['id_user'] ?>'>  
                        <?php endif ?>
                        
                    </td>
                    <td><?php echo $registro['id_user'] ?></td>
                    <td><?php echo $registro['nombre'] ?></td>
                    <td><?php echo $registro['correo'] ?></td>
                    <td><?php echo $registro['fecha_alt'] ?></td>
                    <td><?php echo $registro['direccion'] ?></td>
                    <td>
                        <?php if((isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] != 1) &&
                                            (isset($_SESSION['id_user']) != true || $_SESSION['id_user'] != $registro['id_user'])):?> 
                            <img width='32px' src='../public/images/readonly.png' />
                        <?php else: ?>                
                            <a href='../views/updateUsuario.php?id=<?php echo $registro['id_user'] ?>'><img width='32px' src='../public/images/editar.png' />
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Eliminar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar los registros seleccionados?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Una vez eliminado no se podra recuperar el registro
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="ok2" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
require_once("../views/layout/footer.php");
?>