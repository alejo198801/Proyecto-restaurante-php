
<?php

include("Admin/bd.php");
$sentencia = $conexion->prepare("SELECT * FROM tbl_banners ORDER BY ID DESC limit 1");
$sentencia ->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_chefs ORDER BY ID DESC limit 3");
$sentencia ->execute();
$lista_chefs=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_testimonios ORDER BY ID DESC limit 6");
$sentencia ->execute();
$lista_testimonios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_menu ORDER BY ID DESC limit 4");
$sentencia ->execute();
$lista_platos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    
    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $email =filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $mensaje =filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);
   
    if ($nombre&&$email&&$mensaje) {
        $sql="INSERT INTO tbl_comentarios VALUES (NULL,:nombre,:email,:mensaje)";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':nombre',$nombre,PDO::PARAM_STR);
        $sentencia->bindValue(':email',$email,PDO::PARAM_STR);
        $sentencia->bindValue(':mensaje',$mensaje,PDO::PARAM_STR);
        $sentencia->execute();
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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

        <link 
        rel ="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        crossorigin= "anonymous"
        referrerpolicy="no-referrer"/>


    </head>

    <body>
        <!--Menu de navegacion-->
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">

            <div class="container">
                <a class="navbar-brand" href="#"><i class="fa fa-leaf"></i> Restaurante El rincón de Alejo.</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">                

                    <ul class="nav navbar-nav ml-auto">
                     
                     <li class="nav-item">
                         <a class="nav-link" href="#inicio">Inicio</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="#menu">Menu</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="#chefs">Chefs</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="#testimonios">Testimonios</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="#contacto">Contacto</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="#horario">Horarios</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="\Restaurante\Admin\login.php">Iniciar Sesión</a>
                     </li>

                    </ul>
                </div>

            </div>

        </nav>

        <section id="inicio" class="container-fluid p-0 text-center">

            <div class="banner-img" style="position:relative; background-image:url('images/slider-imagen1.jpg'); background-repeat: no-repeat; height: 600px; background-attachment: fixed;background-position: 70% 50% ">

                <div class="banner-text"style="position:absolute;top:50%;left:50%;transform: translate(-50%,-50%); text-aling: center; color: #FFFFFF">
                     
                    <?php  foreach ($lista_banners as $registro) {                        
                     ?>

                     <h1> <?php echo $registro['titulo'];?></h1>
                     <h2> <?php echo $registro['descripcion'];?></h2>
                     <a href="<?php echo $registro['link'];?>" class="btn btn-secondary text-white hover:background-color: #000000" style="background-color:#0000000"> Productos </a>

                    <?php } ?>

                </div>

            </div>

        </section>
        <!--Mensaje de bienvenida-->
        <section id="id" class="container mt-4 text-center">         
            <div class="jumbotron text-white" style="background-color:#000000">
              <br/>                
              <h2>¡ Bienvenid@ al Restaurante Rincon de Alejo... !</h2>
              <p> Descubre un mundo delicioso a tu alcance... </p>

              <br/>                      
            </div>
        </section>
        <!--Chefs-->
        <section id="chefs" class="container mt-4 text-center">
            <h2>Nuestros Productos</h2>
            <div class="row">
             <?php  foreach ($lista_chefs as $chef) { ?>
                 <div class="col-md-4">
                    <div class="card">
                        <img src="images/colaboradores/<?php echo $chef['imagen'];?>" class="card-img-top" alt="articulos" height="350px" width= "350px"/>
                        <div class="card-body">
                            <h5 class="card-tittle"><?php echo $chef['descripcion'];?>  </h5>
                            <p class="card-text"><?php echo $chef['nombre'];?></p>
                            <div class="social-icons mt-3">
                                <a href="<?php echo $chef['facebook'];?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>                                
                                <a href="<?php echo $chef['instagram'];?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="<?php echo $chef['linkedin'];?>" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                 </div>  
             <?php }?>              
            </div>
        </section>
        <!--Testimonios-->
        <section id="testimonios" class="bg-light py-5">
            <div class="container">
                <h2 class="text-center text-dark fw-bold mb-3"> Testimonios </h2>
                <div class="row">
                 <?php  foreach ($lista_testimonios as $registro) { ?>
                    <div class="col-md-4 d-flex">
                        <div class="card mb-4 w-100">
                            <div class="card-body">
                                <p class="card-text"><?php echo($registro["testimonio"]);?></p>
                            </div>
                            <div class="card-footer text-muted">
                              <?php echo($registro["nombre"]);?>                             
                            </div>
                        </div>
                    </div>
                  <?php }?>                    
                </div>
            </div>
        </section>

        <!--Menu-->
        <section class="container">
            <h2 class="text-center"> Menú (nuestra recomendación ) </h2>
            <br/>
            <div class="row row-cols-1 row-cols-md-4 g-4" id="menu">
                <?php foreach ($lista_platos as $key => $value) {  ?>              
                <div class="col d-flex">
                 <div class="card row justify-content">
                     <img src="images/platos/<?php echo($value["imagen"])?>"class="card-img-center" height="350px" width= "350px">
                      <div class="card-body">
                         <h5 class="card-title"> <?php echo($value["nombre"])?></h5>
                         <p class="card-text small"><strong> Ingredientes:</strong> <?php echo($value["descripcion"])?></p>
                         <p class="card-text"><strong> Precio: </strong><?php echo($value["precio"])?></p>
                      </div>
                 </div>
                </div> 
                <?php }?>         
            </div>
            <br/>
            <br/>
        </section>

        <!--Contacto-->
        <section id="contacto" class="container mt-4">
            <h2> Contacto </h2>
            <p> Estamos aquí para servirle </p>
            <form action="?" method="post">
                <div class="mb-3">
                 <label for="nombre" "> Nombre: </label><br/>
                 <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe aquí tu nombre..." required/><br/><br/>
                </div>
                <div class="mb-3">
                 <label for="email"> Email: </label><br/>
                 <input type="email" class="form-control" name="email" id="email" placeholder="Escribe aquí tu email.." required /><br/><br/>
                </div>
                <div class="mb-1">
                 <label for="mensaje"> Mensaje : </label><br/>
                 <textarea name="mensaje" class="form-control" id="mensaje" rows="6" cols="50"></textarea><br/><br/>
                </div>               
                <input type="submit" class="btn btn-primary bg-dark py-2" value="Enviar mensaje" />
                
            </form>
            <br/>

        </section>

        <!--Horario-->
        <div class="text-center bg-light p-4" id="horario">
            <h3 class="mb-4"> Horario de atención.</h3>
            <div>
                <p><strong> Lunes a Viernes </strong></p>
                <p><strong> 11:00 a.m - 10:00 p.m </strong></p>
            </div>
            <div>
                <p><strong> Sábados </strong></p>
                <p><strong> 9:00 a.m - 11:00 p.m </strong></p>
            </div>
            <div>
                <p><strong> Domingos </strong></p>
                <p><strong> 07:00 a.m - 05:00 p.m </strong></p>
            </div>

        </div>
       


        <footer class="bg-dark text-light text-center py-3">
            <p>&copy;2024, Restaurante el Rincon...Todos los derechos reservados </p>         
        </footer>


        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>



