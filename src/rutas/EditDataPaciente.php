<?php
  include '../config/db.php';
  $Identificacion = $_POST['Identificacion'];
  $Foto = $_POST['Foto'];
  $Nombres = $_POST['Nombres'];
  $Apellidos = $_POST['Apellidos'];
  $FechaNacimiento = $_POST['FechaNacimiento'];
  $Edad = $_POST['Edad'];
  $Direccion = $_POST['Direccion'];
  $Barrio = $_POST['Barrio'];
  $Telefono = $_POST['Telefono'];
  $Ciudad = $_POST['Ciudad'];
  $Estado = $_POST['Estado'];

   $sql = "UPDATE paciente SET Foto='$Foto',Nombres='$Nombres',Apellidos='$Apellidos',FechaNacimiento='$FechaNacimiento',Edad='$Edad',Direccion='$Direccion',Barrio='$Barrio', Telefono='$Telefono',Ciudad='$Ciudad',Estado='$Estado' WHERE Identificacion='$Identificacion'";

  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':Foto', $Foto);
    $resultado->bindParam(':Nombres', $Nombres);
    $resultado->bindParam(':Apellidos', $Apellidos);
    $resultado->bindParam(':FechaNacimiento', $FechaNacimiento);
    $resultado->bindParam(':Edad', $Edad);
    $resultado->bindParam(':Direccion', $Direccion);
    $resultado->bindParam(':Barrio', $Barrio);
    $resultado->bindParam(':Telefono', $Telefono);
    $resultado->bindParam(':Ciudad', $Ciudad);
    $resultado->bindParam(':Estado', $Estado);
    
    $resultado->execute();
    
    if ($resultado->rowCount() > 0) {
      echo json_encode("El paciente fue modificado satisfactoriamente.");
    } else {
      echo json_encode("No existe paciente con esta identificacion.");
    }

    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }

?>
