<?php include("Templates/header.php"); ?>
 <br/>
 <div class="row align-items-md-stretch">
    <div class="col-md-12">
        <div
            class="h-100 p-5 border rounded-3"
        >
            <h2> Bienvenid@ al Administrador <?php echo($_SESSION["usuario"]);?> </h2>
            <p> Este espacio es para administrar su sitio Web </p>
            <button
                class="btn btn-primary bg-dark py-2" type="button" > Iniciar Ahora </button>
        </div>
    </div>    
</div>


<?php include("Templates/footer.php"); ?>