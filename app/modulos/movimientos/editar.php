<?php
    include("../../conexion.php");

    //Recepción de los datos
    if(!isset($_GET["id"])){
        header('Location: ../../index.php?mensaje=error');
        exit();
    }
    
    $id= $_GET["id"];
    $sql = $sql= "SELECT m.fecha, m.tipo, m.descripcion, m.monto, m.forma_de_pago, f.id_familia FROM movimientos m INNER JOIN familiares f ON m.id_familia = f.id_familia WHERE `id_mov` = $id";
    $consulta = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($consulta);

    //Envío de los datos
    if ($_POST){
        $fecha= $_POST["fecha"];
        $tipo= $_POST["tipo"];
        $pago= $_POST["pago"];
        $descripcion= $_POST["descripcion"];
        $monto= $_POST["monto"];
        $familiar= $_POST["familiar"];

        $sqlUpdate = "UPDATE `movimientos` SET `fecha`='$fecha', `tipo`='$tipo', `descripcion`='$descripcion', `monto`='$monto', `forma_de_pago`='$pago', `id_familia`='$familiar' WHERE `id_mov` = $id";
        $update = mysqli_query($conexion, $sqlUpdate);
        header('Location: ../../index.php');
    }

?>

<!--Estructura HTML-->
<?php include("../../template/header.php")?>
<br>
<main class="container">
    <h2 class="mb-3">Editar movimiento</h2>

    <form action="" method="POST">
    <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $id?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="fecha" name="fecha" pattern="\d{4}-\d{2}-\d{2}" value="<?php echo $registro["fecha"]?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="ingreso" value="ingreso" <?php if ($registro["tipo"] == "ingreso") echo "checked"; ?> required>
                    <label class="form-check-label" for="ingreso">Ingreso</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="egreso" value="egreso" <?php if ($registro["tipo"] == "egreso") echo "checked"; ?> required>
                    <label class="form-check-label" for="egreso">Egreso</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Forma de pago</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" id="pago" name="pago" required>
                    <option value="" disabled selected>Seleccione una opción</option>

                    <?php
                        //Opciones disponibles de formas de pago
                        $opcionesFormaPago = array(
                            "efectivo",
                            "cheque",
                            "tarjeta de crédito",
                            "transferencia bancaria"
                        );

                        foreach ($opcionesFormaPago as $opcion) { ?>
                            <option value="<?php echo $opcion; ?>"
                                <?php if ($registro["forma_de_pago"] == $opcion) echo "selected"; ?>>
                                <?php echo $opcion; ?>
                            </option>
                        <?php } ?>
                </select>   

            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $registro["descripcion"]?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Monto</label>
            <div class="col-sm-10">
                <input type="number" id="monto" name="monto" class="form-control" min="0.01" max="9999999.99" step="0.01" pattern="^\d+(\.\d{1,2})?$" inputmode="decimal" value="<?php echo $registro["monto"]?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Realizado por</label>
            <div class="col-sm-10">
            <select class="form-select" aria-label="Default select example" id="familiar" name="familiar" required>
                <option value="" disabled selected>Seleccione una opción</option>
                
                <?php 
                    include("../../conexion.php");

                    $sqlFamilia = "SELECT id_familia, nombre FROM familiares";
                    $consultaFamilia = mysqli_query($conexion, $sqlFamilia);

                    while($fila=mysqli_fetch_assoc($consultaFamilia)){
                        if ($fila["id_familia"] == $registro["id_familia"]) {
                            echo "<option selected value='".$fila["id_familia"]."'>".$fila['nombre']."</option>";
                        } else{
                            echo "<option value='".$fila["id_familia"]."'>".$fila['nombre']."</option>";
                        }
                    }
                    
                ?>
            </select>
            </div>
        </div>
        
        <div class="float-end">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a class="btn btn-danger" href=<?php echo $url_base ?>>Cancelar</a>
        </div>

    </form>

<?php include("../../template/footer.php")?>