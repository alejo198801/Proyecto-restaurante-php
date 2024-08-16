<?php 
include("../../Templates/header.php");
include("../../bd.php");

if (isset($_GET["textID"])) {

    $textID=(isset($_GET["textID"]))?$_GET["textID"]:" ";
    $sentencia=$conexion->prepare("DELETE FROM tbl_banners WHERE ID=:id");
    $sentencia->bindValue(":id",$textID);
    $sentencia->execute();

    header("Location:index.php");
    
}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_banners`");
$sentencia ->execute();
$lista_banners = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<br/>
<br/>
<div class="card">
    <div class="card-header">
      <a
        name=""
        id=""
        class="btn btn-primary bg-dark"
        href="crear.php"
        role="button"
        >Agregar Registros</a
      >       
    </div>
    <div class="card-body">
        <div
            class="table-responsive sm"
        >
            <table
                class="table table-striped"
            >
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>                    
                     <?php
                        foreach ($lista_banners as $key => $value) { ?>                          
                          <tr class="">
                             <td scope="row"><?php echo($value['ID']);?></td>
                             <td><?php echo($value['titulo']);?></td>
                             <td><?php echo($value['descripcion']);?></td>
                             <td><?php echo($value['link']);?></td>
                             <td>
                                 <a name="" id="" class="btn btn-info"href="editar.php?textID=<?php echo($value['ID']);?>"role="button">Editar</a>
                                 <a name="" id="" class="btn btn-danger"href="index.php?textID=<?php echo($value['ID']);?>"role="button">Borrar</a>                            
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