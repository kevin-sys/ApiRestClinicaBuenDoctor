<?php
  include '../config/db.php';
  $Identificacion = $_POST['Identificacion'];
   $sql = "SELECT * FROM paciente WHERE Identificacion='".$Identificacion."'";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->query($sql);

    if ($resultado->rowCount() > 0) {
      $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($clientes);
    } else {
      if ($resultado->rowCount() == 0) {
      $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($clientes);
    } 
    }
    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }

    ?>