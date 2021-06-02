<?php
include '../config/db.php';
$IdentificacionEliminar = $_POST['IdentificacionEliminar'];
$sql = "DELETE FROM paciente WHERE Identificacion= $IdentificacionEliminar";
try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
      echo json_encode("El paciente fue eliminado satisfactoriamente.");
    } else {
      echo json_encode("No existe paciente con esta identificacion.");
    }

    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }
?>