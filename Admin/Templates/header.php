<?php
session_start();
$url_base= "http://localhost/Restaurante/Admin";
if (!isset($_SESSION["usuario"])) {
    header("Location:".$url_base."/login.php");
}

?>
<!doctype html>
<html lang="en">
    <head>
        <title> Administrador del sitio Web </title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
         <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
         <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />  
         <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

         
        </head>

    <body>
        <header>
            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="container">

                  <div class="nav navbar-nav navbar-expand">
                     <a class="nav-item nav-link active" href="<?php echo $url_base;?>/index.php" aria-current="page"
                        >Administrador <span class="visually-hidden">(current)</span></a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/Seccion/Banners/">Banners</a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/Seccion/Colaboradores/">Colaboradores</a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/Seccion/Testimonios/">Testimonios</a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/Seccion/Menu/">Menus</a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/Seccion/Comentarios/">Comentarios</a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/Seccion/Usuarios/">Usuarios</a>
                     <a class="nav-item nav-link" href="<?php echo $url_base;?>/cerrar.php">Cerrar Sesión</a>
                   </div>

                </div>
            </nav>
            
        </header>
        <main>
            <section class="container">