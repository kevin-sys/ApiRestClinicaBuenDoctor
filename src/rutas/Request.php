<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//KEVIN GOMEZ CANTILLO 14/11/2020/03:27am
$app = new \Slim\App;

// GET Todos los pacientes. 
$app->get('/api/paciente', function (Request $request, Response $response) {
  $sql = "SELECT * FROM paciente";
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
});



$app->post('/api/paciente/nuevo', function (Request $request, Response $response) {

  $Identificacion = $request->getParam('Identificacion');
  $Foto = $request->getParam('Foto');
  $Nombres = $request->getParam('Nombres');
  $Apellidos = $request->getParam('Apellidos');
  $FechaNacimiento = $request->getParam('FechaNacimiento');
  $Edad = $request->getParam('Edad');
  $Direccion = $request->getParam('Direccion');
  $Barrio = $request->getParam('Barrio');
  $Telefono = $request->getParam('Telefono');
  $Ciudad = $request->getParam('Ciudad');

  $sql = "INSERT INTO paciente (Identificacion, Foto, Nombres, Apellidos, FechaNacimiento, Edad, Direccion, Barrio, Telefono, Ciudad) VALUES 
          (:Identificacion, :Foto, :Nombres, :Apellidos, :FechaNacimiento, :Edad, :Direccion, :Barrio, :Telefono, :Ciudad)";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->bindParam(':Identificacion', $Identificacion);
    $resultado->bindParam(':Foto', $Foto);
    $resultado->bindParam(':Nombres', $Nombres);
    $resultado->bindParam(':Apellidos', $Apellidos);
    $resultado->bindParam(':FechaNacimiento', $FechaNacimiento);
    $resultado->bindParam(':Edad', $Edad);
    $resultado->bindParam(':Direccion', $Direccion);
    $resultado->bindParam(':Barrio', $Barrio);
    $resultado->bindParam(':Telefono', $Telefono);
    $resultado->bindParam(':Ciudad', $Ciudad);
    $resultado->execute();
    echo json_encode("paciente guardado satisfactoriamente!");

    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }
});



// consultar todos los personales de atencion 
$app->get('/api/personalatencion', function (Request $request, Response $response) {
  $sql = "SELECT * FROM personalatencion";
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
});

//guardar personal de atencion
$app->post('/api/personal/nuevo', function (Request $request, Response $response) {

  $Identificacion = $request->getParam('Identificacion');
  $Foto = $request->getParam('Foto');
  $Nombres = $request->getParam('Nombres');
  $Apellidos = $request->getParam('Apellidos');
  $Tipo = $request->getParam('Tipo');

  $sql = "INSERT INTO personalatencion (Identificacion, Foto, Nombres, Apellidos, Tipo) VALUES 
          (:Identificacion, :Foto, :Nombres, :Apellidos, :Tipo)";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->bindParam(':Identificacion', $Identificacion);
    $resultado->bindParam(':Foto', $Foto);
    $resultado->bindParam(':Nombres', $Nombres);
    $resultado->bindParam(':Apellidos', $Apellidos);
    $resultado->bindParam(':Tipo', $Tipo);
    $resultado->execute();
    echo json_encode("personal de atencion guardado satisfactoriamente!");

    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }
});


//guardar cita 
$app->post('/api/cita/nuevo', function (Request $request, Response $response) {

  $CodigoCita = $request->getParam('CodigoCita');
  $IdentificacionPaciente = $request->getParam('IdentificacionPaciente');
  $NombresPaciente = $request->getParam('NombresPaciente');
  $ApellidosPaciente = $request->getParam('ApellidosPaciente');

  $IdentificacionPersonal = $request->getParam('IdentificacionPersonal');
  $NombresPersonal = $request->getParam('NombresPersonal');
  $ApellidosPersonal = $request->getParam('ApellidosPersonal');
  $TipoPersonal = $request->getParam('TipoPersonal');

  $HoraCita = $request->getParam('HoraCita');
  $FechaCita = $request->getParam('FechaCita');


  $sql = "INSERT INTO citas (CodigoCita, IdentificacionPaciente, NombresPaciente, ApellidosPaciente, IdentificacionPersonal, NombresPersonal, ApellidosPersonal, TipoPersonal, HoraCita, FechaCita) VALUES 
          (:CodigoCita, :IdentificacionPaciente, :NombresPaciente, :ApellidosPaciente, :IdentificacionPersonal, :NombresPersonal, :ApellidosPersonal, :TipoPersonal, :HoraCita, :FechaCita)";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);

    $resultado->bindParam(':CodigoCita', $CodigoCita);
    $resultado->bindParam(':IdentificacionPaciente', $IdentificacionPaciente);
    $resultado->bindParam(':NombresPaciente', $NombresPaciente);
    $resultado->bindParam(':ApellidosPaciente', $ApellidosPaciente);

    $resultado->bindParam(':IdentificacionPersonal', $IdentificacionPersonal);
    $resultado->bindParam(':NombresPersonal', $NombresPersonal);
    $resultado->bindParam(':ApellidosPersonal', $ApellidosPersonal);
    $resultado->bindParam(':TipoPersonal', $TipoPersonal);
    
    $resultado->bindParam(':HoraCita', $HoraCita);
    $resultado->bindParam(':FechaCita', $FechaCita);

    $resultado->execute();
    echo json_encode("Cita guardada satisfactoriamente!");

    $resultado = null;
    $db = null;
  } catch (PDOException $e) {
    echo '{"error" : {"text":' . $e->getMessage() . '}';
  }
});


// GET todas las citas 
$app->get('/api/citas', function (Request $request, Response $response) {
  $sql = "SELECT * FROM citas";
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
});

?>