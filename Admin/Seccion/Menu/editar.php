<?php 
include("../../Templates/header.php");
include("../../bd.php");

if ($_GET) {
    $txtID = (isset($_GET["txtID"]))?$_GET['txtID']:" ";
    $registro=$conexion->prepare("SELECT * FROM tbl_menu WHERE ID=:id");
    $registro->bindValue(":id",$txtID);
    $registro->execute();
    $resultado= $registro->fetch(PDO::FETCH_LAZY);
    
    $imagen=$resultado["imagen"];
    $nombre=$resultado["nombre"];
    $descripcion=$resultado["descripcion"];
    $precio=$resultado["precio"];
    
}

if ($_POST) {

    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:" ";   
    $tmp_foto=$_FILES["imagen"]["tmp_name"];
    if ($tmp_foto!=" "){
      $nueva_imagen=new DateTime();
      $nombre_imagen=$nueva_imagen->getTimestamp()."_".$imagen;      
      move_uploaded_file($tmp_foto,"../../../images/platos/".$nombre_imagen);
      
      $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:" ";
      $registro = $conexion->prepare("SELECT * FROM tbl_menu WHERE ID=:id");
      $registro -> bindValue(':id',$txtID);
      $registro->execute();
      $registro_foto=$registro->fetch(PDO::FETCH_LAZY);
      if (isset($registro_foto["imagen"])) {
          if (file_exists("../../../images/platos/".$registro_foto["imagen"])) {
              unlink ("../../../images/platos/".$registro_foto["imagen"]);           
          }        
      }

      $sentencia = $conexion->prepare("UPDATE tbl_menu SET imagen=:imagen WHERE ID=:id");
      $sentencia->bindValue(":id",$txtID);      
      $sentencia->bindValue(":imagen",$nombre_imagen);
      $sentencia->execute();      
      
    }

    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:" ";
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:" ";
    $precio=(isset($_POST["precio"]))?$_POST["precio"]:" ";
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:" ";

    $sentencia = $conexion->prepare("UPDATE tbl_menu SET nombre=:nombre,descripcion=:descripcion,precio=:precio WHERE ID=:id");
   
    $sentencia->bindValue(":nombre",$nombre);
    $sentencia->bindValue(":descripcion",$descripcion);
    $sentencia->bindValue(":precio",$precio);    
    $sentencia->bindValue(":id",$txtID);

    $sentencia->execute();

    header("Location:index.php");
 }
?>
<br/>
<div class="card">
   <div class="card-header text-light bg-dark">Menus</div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
             <label for="ID" class="form-label"><strong> ID </strong></label>
             <input
             type="text"
             class="form-control"
             name="txtID"
             id="txtID"
             aria-describedby="helpId"
             value="<?php echo $txtID?>">
          </div>         
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Imagen</strong></label><br/>             
             <img  width="120px" height="120px" src="../../../images/platos/<?php echo $imagen ;?>"/>
             <input
             type="file"
             class="form-control"
             name="imagen"
             value="<?php echo($imagen)?>"
             id="imagen"
             aria-describedby="helpId"
             placeholder="Adjunte aca la imagen del chef"/>       
          </div>

          <div class="mb-3">
             <label for="nombre" class="form-label"><strong>Nombre</strong></label>
             <input
             type="text"
             class="form-control"
             name="nombre"
             id="nombre"
             value="<?php echo($nombre)?>"
             aria-describedby="helpId"
             placeholder="Escriba aquí el nombre del plato"/>        
          </div>
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Descripción</strong></label>
             <input
             type="text"
             class="form-control"
             name="descripcion"
             value="<?php echo($descripcion)?>"
             id="descripcion"
             aria-describedby="helpId"
             placeholder="Agregue una descripción aquí"/>        
          </div>
          <div class="mb-3">
             <label for="precio" class="form-label"><strong>Precio</strong></label>
             <input
             type="text"
             class="form-control"
             name="precio"
             value="<?php echo($precio)?>"
             id="precio"
             aria-describedby="helpId"
             placeholder="Ponga el precio aquí"/>        
          </div>
          <button type="submit" class="btn btn-success">Editar</button>
          <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>     
       </form>
    </div>
    <div class="card-footer text-muted"></div>
 </div>
</div>


<?php include("../../Templates/footer.php");?>
