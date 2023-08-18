<?php
    include("../../conexion.php");

    $sql = "SELECT id_familia, nombre FROM familiares";
    $consulta = mysqli_query($conexion, $sql);

    if ($_POST) {
        $fecha= $_POST["fecha"];
        $tipo= $_POST["tipo"];
        $pago= $_POST["pago"];
        $descripcion= $_POST["descripcion"];
        $monto= $_POST["monto"];
        $familiar= $_POST["familiar"];

        $sqlInsert = "INSERT INTO `movimientos` (`id_mov`, `fecha`, `tipo`, `descripcion`, `monto`, `forma_de_pago`, `id_familia`) VALUES (null, '$fecha', '$tipo', '$descripcion', '$monto', '$pago', '$familiar')";
        $insertar = mysqli_query($conexion, $sqlInsert);
    }

?>



<!--Estructura HTML-->
<?php include("../../template/header.php")?>
<br>
<main class="container">
    <h2 class="mb-3">Alta de movimiento</h2>

    <form action="" method="POST">
        <div class="row mb-3">
            <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="fecha" name="fecha" pattern="\d{4}-\d{2}-\d{2}" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="ingreso" value="ingreso" required>
                    <label class="form-check-label" for="ingreso">Ingreso</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="egreso" value="egreso" required>
                    <label class="form-check-label" for="egreso">Egreso</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Forma de pago</label>
            <div class="col-sm-10">
                <?php
                    //Opciones disponibles de formas de pago
                    $opcionesFormaPago = array(
                        "efectivo",
                        "cheque",
                        "tarjeta de crédito",
                        "transferencia bancaria"
                    );
                ?>
                <select class="form-select" aria-label="Default select example" id="pago" name="pago" required>
                    <option value="" disabled selected>Seleccione una opción</option>

                    <?php foreach ($opcionesFormaPago as $opcion) {
                        echo "<option value=".$opcion.">".$opcion."</option>";
                    } ?>
                </select>   
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Monto</label>
            <div class="col-sm-10">
                <input type="number" id="monto" name="monto" class="form-control" min="0.01" max="9999999.99" step="0.01" pattern="^\d+(\.\d{1,2})?$" inputmode="decimal" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Realizado por</label>
            <div class="col-sm-10">
            <select class="form-select" aria-label="Default select example" id="familiar" name="familiar" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <?php while($fila=mysqli_fetch_assoc($consulta)){ ?>
                <option value="<?php echo $fila["id_familia"] ?>"><?php echo $fila["nombre"] ?></option>
                <?php } ?>
            </select>
            </div>
        </div>
        
        <div class="float-end">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a class="btn btn-danger" href=<?php echo $url_base ?>>Cancelar</a>
        </div>

    </form>

<?php include("../../template/footer.php")?>