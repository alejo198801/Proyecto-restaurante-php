<?php 
 include("../../Templates/header.php");
 include("../../bd.php");

 if (isset($_GET["txtID"])) {

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:" ";
    $sentencia=$conexion->prepare("DELETE FROM tbl_testimonios WHERE ID=:id");
    $sentencia->bindValue(":id",$txtID);
    $sentencia->execute();

    header("Location:index.php");    
 }
 
 $sentencia = $conexion->prepare("SELECT * FROM tbl_testimonios");
 $sentencia -> execute();
 $lista_testimonios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<br/>
<div class="card">
    <div class="card-header">
     <a name="" id="" class="btn btn-primary bg-dark" href="crear.php" role="button"
        >Agregar Registros</a>
    </div>
   
    <div class="card-body">
        <div
            class="table-responsive-sm"
        >
            <table
                class="table table-striped"
            >
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Opinion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_testimonios as $fila) { ?>
                     <tr class="">
                         <td scope="row"><?php echo ($fila["ID"]);?></td>
                         <td><?php echo ($fila["nombre"]);?></td>
                         <td><?php echo ($fila["testimonio"]);?></td>
                         <td>
                             <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo ($fila["ID"]);?>" role="button">Editar</a>
                             <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo ($fila["ID"]);?>" role="button">Borrar</a> 
                         </td>
                     </tr>
                    <?php } ?>                   
                </tbody>
            </table>
        </div>
        
    
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../Templates/footer.php");?>