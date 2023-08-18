<?php
    include("conexion.php");

    $sql= "SELECT m.id_mov, m.fecha, m.tipo, m.descripcion, m.monto, m.forma_de_pago, f.nombre FROM movimientos m INNER JOIN familiares f ON m.id_familia = f.id_familia ORDER BY m.fecha desc";
    $consulta = mysqli_query($conexion, $sql);

?>


<!--Estructura HTML-->
<?php include("template/header.php")?>
<br>
<main class="container">

    <div class="d-flex justify-content-between">
        <h2>Lista de movimientos</h2>
        <a class="btn btn-primary align-self-center" href="modulos/movimientos/alta.php">Nuevo</a>
    </div>
    

    <table class="table table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tipo</th>
                <th scope="col">Forma de pago</th>
                <th scope="col">Descripción</th>
                <th scope="col">Monto</th>
                <th scope="col">Realizado por</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila=mysqli_fetch_assoc($consulta)){ ?>
                <tr>
                    <th scope="row"><?php echo $fila["id_mov"]; ?></td>
                    <td><?php echo $fila["fecha"]; ?></td>
                    <td><?php echo $fila["tipo"]; ?></td>
                    <td><?php echo $fila["forma_de_pago"]; ?></td>
                    <td><?php echo $fila["descripcion"]; ?></td>
                    <td>$ <?php echo $fila["monto"]; ?></td>
                    <td><?php echo $fila["nombre"]; ?></td>
                    <td>
                    <a class="btn btn-success" href="modulos/movimientos/editar.php?id=<?php echo $fila["id_mov"]?>">Editar</a>
                    <a onclick="return confirm('¿Desea eliminar el movimiento?')" class="btn btn-danger" href="modulos/movimientos/eliminar.php?id=<?php echo $fila["id_mov"]?>">Eliminar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php include("template/footer.php")?>