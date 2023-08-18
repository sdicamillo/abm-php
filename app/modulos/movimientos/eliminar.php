<?php include("../../conexion.php");

if(!isset($_GET["id"])){
  header('Location: ../../index.php?mensaje=error');
  exit();
}

$id= $_GET["id"];
$sql = "DELETE FROM `movimientos` WHERE `id_mov` = $id";
$consulta = mysqli_query($conexion, $sql);
header('Location: ../../index.php');
?>
