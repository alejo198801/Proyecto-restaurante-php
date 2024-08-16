<?php 
 include("../../Templates/header.php");
 include("../../bd.php");

 if ($_POST) {
    
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:" ";
    $testimonio=(isset($_POST["testimonio"]))?$_POST["testimonio"]:" ";
   

    $sentencia=$conexion->prepare("INSERT INTO tbl_testimonios VALUES(NULL,:nombre,:testimonio);");
    $sentencia->bindValue(":nombre",$nombre);
    $sentencia->bindValue(":testimonio",$testimonio);    
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
             <label for="nombre" class="form-label"><strong> Nombre </strong></label>
             <input
             type="text"
             class="form-control"
             name="nombre"
             id="nombre"
             aria-describedby="helpId"
             placeholder="Escriba su nombre aquí"/>   
          </div>
          <div class="mb-3">
             <label for="descripcion" class="form-label"><strong>Opinion</strong></label>
             <input
             type="text"
             class="form-control"
             name="testimonio"
             id="testimonio"
             aria-describedby="helpId"
             placeholder="Escriba aca su opinión"/>       
          </div>
          <button type="submit" class="btn btn-success"> Registrar </button>
         <a name="cancelar"id="cancelar"class="btn btn-danger"href="index.php"role="button"> Cancelar </a>     
       </form>
    </div>
   <div class="card-footer text-muted"></div>
</div>       




<?php include("../../Templates/footer.php");?>
