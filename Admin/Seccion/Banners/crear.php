<?php include("../../Templates/header.php");
 include("../../bd.php");
 if ($_POST) {
    
    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:" ";
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:" ";
    $link=(isset($_POST["link"]))?$_POST["link"]:" ";

    $sentencia=$conexion->prepare("INSERT INTO tbl_banners VALUES(NULL,:titulo,:descripcion,:link);");
    $sentencia->bindValue(":titulo",$titulo);
    $sentencia->bindValue(":descripcion",$descripcion);
    $sentencia->bindValue(":link",$link);
    $sentencia->execute();

    header("Location:index.php");
 }
?>
<br/> 

<div class="card">
    <div class="card-header text-light bg-dark">Banners</div>
    <div class="card-body">
       <form action="" method="post">
         <div class="mb-3">
             <label for="titulo" class="form-label"><strong> Titulo </strong></label>
             <input
             type="text"
             class="form-control"
             name="titulo"
             id="titulo"
             aria-describedby="helpId"
             placeholder="Escriba el titulo del banner"/>   
          </div>
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Descripcion</strong></label>
             <input
             type="text"
             class="form-control"
             name="descripcion"
             id="descripcion"
             aria-describedby="helpId"
             placeholder="Escriba aquí la descripción del banner"/>       
          </div>

         <div class="mb-3">
             <label for="link" class="form-label"><strong>Link</strong></label>
             <input
             type="text"
             class="form-control"
             name="link"
             id="link"
             aria-describedby="helpId"
             placeholder="Adjunte aquí el link de la imagen"/>        
          </div>
         <button type="submit" class="btn btn-success"> Registrar </button>
         <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>     
       </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../Templates/footer.php");?>