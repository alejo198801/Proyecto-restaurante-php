<?php 
 include("../../Templates/header.php");
 include("../../bd.php");

 if ($_POST) {
   
    $imagen=(isset($_FILES['imagen']["name"]))?$_FILES['imagen']["name"]:" ";
    $nueva_imagen=new DateTime();
    $nombre_imagen=$nueva_imagen->getTimestamp()."_".$imagen;
    $tmp_foto=$_FILES["imagen"]["tmp_name"];
    if ($tmp_foto!=""){
      move_uploaded_file($tmp_foto,"../../../images/platos/".$nombre_imagen);
    }
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:" ";    
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:" ";
    $precio=(isset($_POST["precio"]))?$_POST["precio"]:" ";

    $sentencia = $conexion->prepare("INSERT INTO tbl_menu VALUES
     (NULL,:imagen,:nombre,:descripcion,:precio);");
     
    $sentencia->bindValue(':imagen',$nombre_imagen);   
    $sentencia->bindValue(':nombre',$nombre);       
    $sentencia->bindValue(':descripcion',$descripcion);
    $sentencia->bindValue(':precio',$precio);   
    $sentencia->execute();

    header("Location:index.php");  

 }
?>
<br/>
<div class="card">
  <div class="card-header text-light bg-dark">Creación de Menus</div>
     <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">         
          <div class="mb-3">
             <label for="imagen" class="form-label"><strong>Imagen</strong></label>
             <input
             type="file"
             class="form-control"
             name="imagen"
             id="imagen"
             aria-describedby="helpId"
             placeholder="Adjunte imagen del menu"/>   
          </div>      
          <div class="mb-3">
             <label for="nombre" class="form-label"><strong>Nombre</strong></label>
             <input
             type="text"
             class="form-control"
             name="nombre"
             id="nombre"
             aria-describedby="helpId"
             placeholder="Escriba el nombre del Menu"/>       
          </div>          
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Descripción</strong></label>
             <input
             type="text"
             class="form-control"
             name="descripcion"
             id="descripcion"
             aria-describedby="helpId"
             placeholder="Proporcione una descripcion"/>        
          </div>
          <div class="mb-3">
             <label for="precio" class="form-label"><strong>Precio</strong></label>
             <input
             type="text"
             class="form-control"
             name="precio"
             id="precio"
             aria-describedby="helpId"
             placeholder="Proporcione el precio del menu"/>        
          </div>
          <button type="submit" class="btn btn-success"> Crear Menu </button>
          <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>            
      </form>
    </div>
  </div>
</div>
<?php include("../../Templates/footer.php");?>