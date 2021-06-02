<?php
  include '../config/db.php';
  $Identificacion = $_POST['Identificacion'];
  $Foto = $_POST['Foto'];
  $Nombres = $_POST['Nombres'];
  $Apellidos = $_POST['Apellidos'];
  $Tipo = $_POST['Tipo'];
  $Estado = $_POST['Estado'];
  $Trabajando = $_POST['Trabajando'];

   $sql = "UPDATE personalatencion SET Foto='$Foto',Nombres='$Nombres',Apellidos='$Apellidos',Tipo='$Tipo',Estado='$Estado',Trabajando='$Trabajando' WHERE Identificacion='$Identificacion'";

  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':Foto', $Foto);
    $resultado->bindParam(':Nombres', $Nombres);
    $resultado->bindParam(':Apellidos', $Apellidos);
    $resultado->bindParam(':Tipo', $Tipo);
    $resultado->bindParam(':Estado', $Estado);
    $resultado->bindParam(':Trabajando', $Trabajando);

    
    $resultado->execute();
    
    if ($resultado->rowCount() > 0) {
      echo json_encode("El personal de atencion fue modificado satisfactoriamente.");
    } else {
      echo json_encode("No existe personal con esta identificacion.");
    }

    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }

?>
