<?php
include 'Static/connect/db.php';
date_default_timezone_set('America/Mexico_City'); // Ajusta la zona horaria según tu ubicación

if (isset($_GET['doctor_id']) && isset($_GET['fecha'])) {
    $doctor_id = $_GET['doctor_id'];
    $fecha = $_GET['fecha'];
    $hora_seleccionada = isset($_GET['hora']) ? $_GET['hora'] : '';

    // Obtener las horas de inicio y fin de atención del doctor
    $sql = "SELECT Horario_Atencion_I, Horario_Atencion_F FROM doctor WHERE idDoctor = '$doctor_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hora_inicio = $row['Horario_Atencion_I'];
        $hora_fin = $row['Horario_Atencion_F'];
    } else {
        echo "Error: No se encontraron las horas de atención del doctor.";
        $conn->close();
        exit();
    }

    // Obtener las horas ocupadas
    $sql = "SELECT Hora FROM cita WHERE Doctor_idDoctor = '$doctor_id' AND Fecha_Cita = '$fecha'";
    $result = $conn->query($sql);
    $horas_ocupadas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row["Hora"]!=$hora_seleccionada){
            $horas_ocupadas[] = $row["Hora"];
            }
        }
    }

    
// Generar las opciones de horas disponibles en intervalos de 20 minutos
    $hora_actual = strtotime($hora_inicio);
    $hora_fin_timestamp = strtotime($hora_fin);
    $fecha_hora_actual = strtotime(date('Y-m-d H:i:s')); // Obtener la fecha y hora actual
    
 

    
    

    while ($hora_actual < $hora_fin_timestamp) {
        $hora_formateada = date('H:i:s', $hora_actual);
        $fecha_hora_formateada = strtotime("$fecha $hora_formateada");
       
        

        if ($fecha_hora_formateada >= $fecha_hora_actual && !in_array($hora_formateada, $horas_ocupadas)) {
            $selected = ($hora_formateada == $hora_seleccionada) ? 'selected' : '';
            echo "<option value='$hora_formateada' $selected>" . substr($hora_formateada, 0, 5) . "</option>";
            
        }

        $hora_actual = strtotime('+20 minutes', $hora_actual);
    }
    
}
?>
