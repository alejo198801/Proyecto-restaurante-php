<?php 
 include("../../Templates/header.php");
 include("../../bd.php");

 if (isset($_GET["textID"])) {

    $textID=(isset($_GET["textID"]))?$_GET["textID"]:" ";
    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
    $sentencia->bindValue(":id",$textID);
    $sentencia->execute();

    header("Location:index.php");
    
}

 $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios");
 $sentencia -> execute();
 $lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<br/>
<div class="card">
     <div class="card-header"> 
         <a name="" id="" class="btn btn-primary bg-dark" href="crear.php" role="button">Agregar Usuarios </a>
     </div>
     <div class="card-body">
        <div
            class="table-responsive-sm">        
            <table
                class="table table-striped"
            >
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista_usuarios as $fila) { ?>
                     <tr class="">
                         <td scope="row"><?php echo($fila['ID']);?></td>
                         <td><?php echo($fila['usuario']);?></td>
                         <td><?php echo($fila['email']);?></td>
                         <td>*****</td>
                         <td>                             
                             <a name="" id="" class="btn btn-danger" href="index.php?textID=<?php echo($fila['ID']);?>" role="button">Borrar</a> 
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