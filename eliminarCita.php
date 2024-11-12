<?php  include 'Static/connect/db.php'?>
<?php


    $id= $conn->real_escape_string($_POST['id']);

    $sqlTablaCruzada = "DELETE FROM cita_has_cuestionario WHERE Cita_idCita=$id";

    mysqli_query($conn,$sqlTablaCruzada);

    $sqlCita = "DELETE FROM cita WHERE idCita=$id";

    mysqli_query($conn,$sqlCita);

    header("Location: consultarCitaPaciente.php");


?>