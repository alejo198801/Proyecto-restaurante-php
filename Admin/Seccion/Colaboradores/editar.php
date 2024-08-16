<?php 
include("../../Templates/header.php");
include("../../bd.php");

if ($_GET) {
    $txtID = (isset($_GET["txtID"]))?$_GET['txtID']:" ";
    $registro=$conexion->prepare("SELECT * FROM tbl_chefs WHERE ID=:id");
    $registro->bindValue(":id",$txtID);
    $registro->execute();
    $resultado= $registro->fetch(PDO::FETCH_LAZY);
    
    $imagen=$resultado["imagen"];
    $nombre=$resultado["nombre"];
    $descripcion=$resultado["descripcion"];
    $facebook=$resultado["facebook"];
    $instagram=$resultado["instagram"];
    $linkedin=$resultado["linkedin"];
}

if ($_POST) {

    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:" ";   
    $tmp_foto=$_FILES["imagen"]["tmp_name"];
    if ($tmp_foto!=" "){
      $nueva_imagen=new DateTime();
      $nombre_imagen=$nueva_imagen->getTimestamp()."_".$imagen;      
      move_uploaded_file($tmp_foto,"../../../images/colaboradores/".$nombre_imagen);
      
      $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:" ";
      $registro = $conexion->prepare("SELECT * FROM tbl_chefs WHERE ID=:id");
      $registro -> bindValue(':id',$txtID);
      $registro->execute();
      $registro_foto=$registro->fetch(PDO::FETCH_LAZY);
      if (isset($registro_foto["imagen"])) {
          if (file_exists("../../../images/colaboradores/".$registro_foto["imagen"])) {
              unlink ("../../../images/colaboradores/".$registro_foto["imagen"]);           
          }        
      }

      $sentencia = $conexion->prepare("UPDATE tbl_chefs SET imagen=:imagen WHERE ID=:id");
      $sentencia->bindValue(":id",$txtID);      
      $sentencia->bindValue(":imagen",$nombre_imagen);
      $sentencia->execute();      
      
    }

    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:" ";
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:" ";
    $facebook=(isset($_POST["facebook"]))?$_POST["facebook"]:" ";
    $instagram=(isset($_POST["instagram"]))?$_POST["instagram"]:" ";
    $linkedin=(isset($_POST["linkedin"]))?$_POST["linkedin"]:" ";
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:" ";

    $sentencia = $conexion->prepare("UPDATE tbl_chefs SET nombre=:nombre,descripcion=:descripcion,facebook=:facebook,instagram=:instagram,linkedin=:linkedin WHERE ID=:id");
   
    $sentencia->bindValue(":nombre",$nombre);
    $sentencia->bindValue(":descripcion",$descripcion);
    $sentencia->bindValue(":facebook",$facebook);
    $sentencia->bindValue(":instagram",$instagram);
    $sentencia->bindValue(":linkedin",$linkedin);
    $sentencia->bindValue(":id",$txtID);

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
             <label for="nombre" class="form-label"><strong> Nombre </strong></label>
             <input
             type="text"
             class="form-control"
             name="nombre"
             id="nombre"
             value="<?php echo($nombre)?>"
             aria-describedby="helpId"
             placeholder="Escriba el nombre del Chef"/>   
          </div>
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Imagen</strong></label><br/>             
             <img  width="120px" height="120px" src="../../../images/colaboradores/<?php echo $imagen ;?>"/>
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
             <label for="link" class="form-label"><strong>Descripción</strong></label>
             <input
             type="text"
             class="form-control"
             name="descripcion"
             id="descripcion"
             value="<?php echo($descripcion)?>"
             aria-describedby="helpId"
             placeholder="Proporcione una descripcion"/>        
          </div>

          <div class="mb-3">
             <label for="link" class="form-label"><strong>Facebook</strong></label>
             <input
             type="text"
             class="form-control"
             name="facebook"
             value="<?php echo($facebook)?>"
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
             value="<?php echo($instagram)?>"
             id="instagram"
             aria-describedby="helpId"
             placeholder="Copie aquí la red social instagram"/>        
          </div>

          <div class="mb-3">
             <label for="link" class="form-label"><strong>Linkedin</strong></label>
             <input
             type="text"
             class="form-control"
             value="<?php echo($linkedin)?>"
             name="linkedin"
             id="linkedin"
             aria-describedby="helpId"
             placeholder="Copie aquí la red social linkedin"/>        
          </div>

         <button type="submit" class="btn btn-success">Editar</button>
         <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>     
       </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Templates/footer.php");?>
