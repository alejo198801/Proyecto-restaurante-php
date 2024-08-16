<?php include("../../Templates/header.php");
 include("../../bd.php");
 if ($_POST) {
    
    $usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:" ";
    $email=(isset($_POST["email"]))?$_POST["email"]:" ";    
    $password=(isset($_POST["password"]))?$_POST["password"]:" ";
    $password=md5($password);

    $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios VALUES(NULL,:usuario,:email,:password);");
    $sentencia->bindValue(":usuario",$usuario);
    $sentencia->bindValue(":email",$email);
    $sentencia->bindValue(":password",$password);
    $sentencia->execute();

    header("Location:index.php");
 }
?>
<br/>
<div class="card">
    <div class="card-header text-light bg-dark">Usuarios</div>
    <div class="card-body">
       <form action="" method="post">
         <div class="mb-3">
             <label for="usuario" class="form-label"><strong>Nombre Usuario</strong></label>
             <input
             type="text"
             class="form-control"
             name="usuario"
             id="usuario"
             aria-describedby="helpId"
             placeholder="Escriba el nombre del usuario"/>   
          </div>
          <div class="mb-3">
             <label for="email" class="form-label"><strong>Email</strong></label>
             <input
             type="email"
             class="form-control"
             name="email"
             id="email"
             aria-describedby="helpId"
             placeholder="Escriba aquí un email válido"/>       
          </div>

         <div class="mb-3">
             <label for="password" class="form-label"><strong>Password</strong></label>
             <input
             type="password"
             class="form-control"
             name="password"
             id="password"
             aria-describedby="helpId"
             placeholder="proporcione una clave segura"/>        
          </div>
         <button type="submit" class="btn btn-success"> Registrar </button>
         <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>     
       </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Templates/footer.php");?>


