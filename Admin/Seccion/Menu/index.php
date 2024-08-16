
<?php 
include("../../Templates/header.php");
include("../../bd.php");

if (isset($_GET['txtID'])) {
    
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
 $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:" ";
 $registro = $conexion->prepare("DELETE FROM tbl_menu WHERE ID=:id");
 $registro -> bindValue(':id',$txtID);
 $registro->execute();

 header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_menu"); 
$sentencia -> execute();
$lista_menus=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<br/>
<div class="card">
    <div class="card-header">
    <a
        name=""
        id=""
        class="btn btn-primary bg-dark"
        href="crear.php"
        role="button"
        >Agregar Menu</a
      >       
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>                      
                        <th scope="col">Acciones</th>                      
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($lista_menus as $fila) { ?>                   
                     <tr class="">
                         <td scope="row"><?php echo ($fila['ID']);?></td>
                         <td scope="row"><img src="../../../images/platos/<?php echo ($fila['imagen']);?>" alt="Foto del plato de menu"
                             width="50px" height="60px"></td>
                         <td><?php echo ($fila['nombre']);?></td>                                                
                         <td><?php echo ($fila['descripcion']);?></td>
                         <td><?php echo ($fila['precio']);?></td>                        
                         <td>
                             <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo ($fila['ID']);?>" role="button">Editar</a>
                             <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo ($fila['ID']);?>" role="button">Borrar</a>                            
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