<?php 
include("../../Templates/header.php");
include("../../bd.php");

if ($_POST) {
   
    $imagen=(isset($_FILES['imagen']["name"]))?$_FILES['imagen']["name"]:" ";
    $nueva_imagen=new DateTime();
    $nombre_imagen=$nueva_imagen->getTimestamp()."_".$imagen;
    $tmp_foto=$_FILES["imagen"]["tmp_name"];
    if ($tmp_foto!=""){
      move_uploaded_file($tmp_foto,"../../../images/colaboradores/".$nombre_imagen);
    }

    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:" ";    
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:" ";
    $facebook=(isset($_POST["facebook"]))?$_POST["facebook"]:" ";
    $instagram=(isset($_POST["instagram"]))?$_POST["instagram"]:" ";
    $linkedin=(isset($_POST["linkedin"]))?$_POST["linkedin"]:" ";

    $sentencia = $conexion->prepare("INSERT INTO tbl_chefs VALUES
     (NULL,:imagen,:nombre,:descripcion,:facebook,:instagram,:linkedin);");
    
    $sentencia->bindValue(':imagen',$nombre_imagen);
    $sentencia->bindValue(':nombre',$nombre);   
    $sentencia->bindValue(':descripcion',$descripcion);
    $sentencia->bindValue(':facebook',$facebook);
    $sentencia->bindValue(':instagram',$instagram);
    $sentencia->bindValue(':linkedin',$linkedin);
    $sentencia->execute();

    header("Location:index.php");   

}
?>
<br/>
<div class="card">
    <div class="card-header text-light bg-dark">Colaboradores</div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">
         <div class="mb-3">
             <label for="nombre" class="form-label"><strong> Nombre </strong></label>
             <input
             type="text"
             class="form-control"
             name="nombre"
             id="nombre_1"
             aria-describedby="helpId"
             placeholder="Escriba el nombre del Chef"/>   
          </div>
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Imagen</strong></label>
             <input
             type="file"
             class="form-control"
             name="imagen"
             id="imagen"
             aria-describedby="helpId"
             placeholder="Adjunte aca la imagen del chef"/>       
          </div>

         <div class="mb-3">
             <label for="link" class="form-label"><strong>Descripción</strong></label>
             <input
             type="text"
             class="form-control"
             name="descripcion"
             id="descripcion"
             aria-describedby="helpId"
             placeholder="Proporcione una descripcion"/>        
          </div>

          <div class="mb-3">
             <label for="link" class="form-label"><strong>Facebook</strong></label>
             <input
             type="text"
             class="form-control"
             name="facebook"
             id="facebook"
             aria-describedby="helpId"
             placeholder="Copie aquí la red social Facebook"/>        
          </div>

          <div class="mb-3">
             <label for="link" class="form-label"><strong>Instagram</strong></label>
             <input
             type="text"
             class="form-control"
             name="instagram"
             id="instagram"
             aria-describedby="helpId"
             placeholder="Copie aquí la red social instagram"/>        
          </div>

          <div class="mb-3">
             <label for="link" class="form-label"><strong>Linkedin</strong></label>
             <input
             type="text"
             class="form-control"
             name="linkedin"
             id="linkedin"
             aria-describedby="helpId"
             placeholder="Copie aquí la red social linkedin"/>        
          </div>

         <button type="submit" class="btn btn-success"> Registrar </button>
         <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>     
       </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Templates/footer.php");?>
