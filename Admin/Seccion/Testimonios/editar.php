<?php include("../../Templates/header.php");
 include("../../bd.php");
 if (isset($_GET["txtID"])) {

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:" ";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_testimonios` WHERE ID=:id");
    $sentencia->bindValue(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombre=$registro["nombre"];
    $testimonio=$registro["testimonio"];        
 }

 if ($_POST) {
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:" ";
    $testimonio=(isset($_POST["testimonio"]))?$_POST["testimonio"]:" ";    
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:" ";

    $sentencia=$conexion->prepare("UPDATE tbl_testimonios SET nombre=:nombre,testimonio=:testimonio WHERE ID=:id");
    $sentencia->bindValue(":nombre",$nombre);
    $sentencia->bindValue(":testimonio",$testimonio);   
    $sentencia->bindValue(":id",$txtID);
    $sentencia->execute();

    header("Location:index.php");

 }

?>
<br/>
<div class="card">
    <div class="card-header text-light bg-dark">Testimonios</div>
  <div class="card-body">
     <form action="" method="post">
          <div class="mb-3">
             <label for="ID" class="form-label"><strong> ID </strong></label>
                 <input
                 type="text"
                 class="form-control"
                 name="textID"
                 id="textID"
                 aria-describedby="helpId"
                 value="<?php echo $txtID?>">
          </div>
          <div class="mb-3">
             <label for="titulo" class="form-label"><strong> Nombre </strong></label>
                 <input
                 type="text"
                 class="form-control"
                 name="titulo"
                 id="titulo"
                 aria-describedby="helpId"
                 value="<?php echo $nombre?>"
                 />       
          </div>
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Testimonio</strong></label>
                 <input
                 type="text"
                 class="form-control"
                 name="descripcion"
                 id="descripcion"
                 aria-describedby="helpId"
                 value="<?php echo $testimonio?>"            
                 />       
          </div>
         <button type="submit" class="btn btn-success"> Editar Comentario </button>
         <a
         name="cancelar"
         class="btn btn-danger"
         href="index.php"
         role="button"
         > Cancelar </a>      
      </form>
  </div>
  <div class="card-footer text-muted"></div>
</div>

<?php include("../../Templates/footer.php");?>


<?php include("../../Templates/footer.php");?>