<?php 
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark px-5" >
            <div class="container-fluid">
                <a class="navbar-brand h1 mb-0" href="../views/index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_SESSION['id_rol']) != true || $_SESSION['id_rol'] != 1){ echo " ". "disabled";}?>" href="../views/crearUsuario.php">Crear usuarios</a>
                        </li>
                        <li class="nav-item ">
                            
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <a class="nav-link" href="../views/logout.php">Cerrar Sesion</a>
                    </span>
                </div>
            </div>
        </nav>
        <div class="position-relative " style="min-height: 94.2vh">
            <div class="container pt-5 bg-light" style="padding-bottom: 5rem">