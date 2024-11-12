<?php  include 'Static/connect/db.php'?>
<?php
        $salida = "";
        $sql = "SELECT *  FROM cita";
        

        $result = $conn->query($sql);

        // Mostrar los resultados
        if ($result->num_rows > 0) {

            $salida .= "<table class='table  table-bordered border-dark table-striped-columns'>
                    <caption>Lista de usuarios</caption>
                    <thead>
                    <tr>
                    <th>Nombre del paciente</th>
                    <th>Fecha de la cita</th>
                    <th>Hora asignada</th>
                    <th>Informacion</th>
                    <th>Receta</th>
                    <th>Cancelar</th>
                    </tr>
                    </thead>
                    ";

            while ($row = $result->fetch_assoc()) {

                $sqlNomDoc = "SELECT Nombre, A_Paterno FROM paciente WHERE idPaciente = " . $row["Paciente_idPaciente"];
                $resultDoc= mysqli_query($conn, $sqlNomDoc);
                $rowDoc = $resultDoc->fetch_assoc();

                $sqltablaCruzada = "SELECT * FROM cita_has_cuestionario WHERE Cita_idCita = " . $row["idCita"];
                $resultTabla= mysqli_query($conn, $sqltablaCruzada);
                $rowTabla = $resultTabla->fetch_assoc();

                $sqlCuestionario= "SELECT * FROM cuestionario WHERE idCuestionario = " . $rowTabla["Cuestionario_idCuestionario"];
                $resultCuestionario= mysqli_query($conn, $sqlCuestionario);
                $rowCuestionario = $resultCuestionario->fetch_assoc();
                $salida .= "<tr>
                
                <td style='visibility:collapse; display:none;'>".$row["idCita"]."</td>
                <td>".$rowDoc["Nombre"]." ". $rowDoc["A_Paterno"]."</td>
                <td>".$row["Fecha_Cita"]."</td>
                <td>".$row["Hora"]."</td>
                


                <th><a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalPaciente' data-bs-id='" . $row["idCita"] . "'>Ver mas</a> </th> 
                <th><a class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modalReceta' data-bs-id='" . $row["idCita"] . "'>Generar</a></th>
                <th><a class='btn btn-danger' href='actualizarDoctor.php?id=" . $row['idCita'] . "'>Cancelar</a></th>

                </tr>
            
            ";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
        }


        echo $salida;
?>

