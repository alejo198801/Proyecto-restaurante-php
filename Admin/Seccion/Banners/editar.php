<?php include("../../Templates/header.php");
 include("../../bd.php");
 if (isset($_GET["textID"])) {

    $textID=(isset($_GET["textID"]))?$_GET["textID"]:" ";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_banners` WHERE ID=:id");
    $sentencia->bindValue(":id",$textID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
    $link=$registro["link"];       
}
 if ($_POST) {
    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:" ";
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:" ";
    $link=(isset($_POST["link"]))?$_POST["link"]:" ";
    $textID=(isset($_POST["textID"]))?$_POST["textID"]:" ";

    $sentencia=$conexion->prepare("UPDATE tbl_banners SET titulo=:titulo,descripcion=:descripcion,link=:link WHERE ID=:id");
    $sentencia->bindValue(":titulo",$titulo);
    $sentencia->bindValue(":descripcion",$descripcion);
    $sentencia->bindValue(":link",$link);
    $sentencia->bindValue(":id",$textID);
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
         <label for="ID" class="form-label"><strong> ID </strong></label>
         <input
            type="text"
            class="form-control"
            name="textID"
            id="textID"
            aria-describedby="helpId"
            value="<?php echo $textID?>">
       </div>
        <div class="mb-3">
        <label for="titulo" class="form-label"><strong> Titulo </strong></label>
        <input
            type="text"
            class="form-control"
            name="titulo"
            id="titulo"
            aria-describedby="helpId"
            value="<?php echo $titulo?>"
        />       
       </div>
       <div class="mb-3">
        <label for="descripcion" class="form-label"><strong>Descripcion</strong></label>
        <input
            type="text"
            class="form-control"
            name="descripcion"
            id="descripcion"
            aria-describedby="helpId"
            value="<?php echo $descripcion?>"
            
        />       
       </div>

       <div class="mb-3">
        <label for="link" class="form-label"><strong>Link</strong></label>
        <input
            type="text"
            class="form-control"
            name="link"
            id="link"
            aria-describedby="helpId"
            value="<?php echo $link?>"
                      
            
        />        
       </div>
       <button type="submit" class="btn btn-success"> Modificar Banner </button>
       <a
        name="cancelar"
        id="cancelar"
        class="btn btn-danger"
        href="index.php"
        role="button"
        > Cancelar </a>     
           
       
       </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../Templates/footer.php");?>