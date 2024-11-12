<?php  include 'Static/connect/db.php'?>
<?php

    session_start();
    $Tipo = $_SESSION['Tipo'];
    $idUsuario= $_SESSION['idUsuarioPa'];

    if(isset($_SESSION['Tipo'] ) && $Tipo=="Paciente"){
        
        ?>
        
        <?php
    }
    else
    {
        header("Location:login.php");
    }


?>    




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Usuarios</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
     <!-- Tu archivo de estilos personalizado -->
     <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboardPaciente.php">
                    <img src="Static/img/upemor_logo.png" alt="Bootstrap" width="50" >
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    
                    <a class="nav-link" href="#">Perfil</a>
                    <a class="nav-link" href="logout.php">Cerrar sesion</a>
                    
                </div>
                </div>
            </div>
            </nav>



<div class="container containerCon" >
    <h2 style="color: black;">Consulta de citas</h2>

    
    
    
    <div class="search-bar " id="barraBusqueda">
        <form method="GET" action="">
            <input type="date"  id="fechaBusqueda" name="fechaBusqueda" placeholder="Nombre de usuario" >
            <button type="submit">🔍</button>
        </form>
    </div>

    
    <div class="table-responsive " id="tablaCitas">


    <!-- Tabla de usuarios -->
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nombre del doctor</th>
            <th>Fecha</th>
            <th>Hora de la cita</th>
            <th>Estado de la cita</th>
            <th>¿Qué sintomas presenta?</th>
            <th>¿Cuenta con alergias?</th>
            <th>¿Qué medicamentos actuales toma?</th>
            <th>¿Alguna condición hereditaria?</th>
            <th>¿En qué parte del cuerpo presenta el dolor?</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
        

        // Obtener el valor de búsqueda si está definido
        $search = isset($_GET['fechaBusqueda']) ? $conn->real_escape_string($_GET['fechaBusqueda']) : "";

        // Consulta SQL
        $sql = "SELECT *  FROM cita where Paciente_idPaciente=$idUsuario";
        if ($search) {
            $sql .= " AND Fecha_Cita = '$search'";
        }

        $result = $conn->query($sql);

        // Mostrar los resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $sqlNomDoc = "SELECT Nombre FROM doctor WHERE idDoctor = " . $row["Doctor_idDoctor"];
                $resultDoc= mysqli_query($conn, $sqlNomDoc);
                $rowDoc = $resultDoc->fetch_assoc();

                $sqltablaCruzada = "SELECT * FROM cita_has_cuestionario WHERE Cita_idCita = " . $row["idCita"];
                $resultTabla= mysqli_query($conn, $sqltablaCruzada);
                $rowTabla = $resultTabla->fetch_assoc();

                $sqlCuestionario= "SELECT * FROM cuestionario WHERE idCuestionario = " . $rowTabla["Cuestionario_idCuestionario"];
                $resultCuestionario= mysqli_query($conn, $sqlCuestionario);
                $rowCuestionario = $resultCuestionario->fetch_assoc();




                echo "<tr>";
                echo "<td>" . $row["idCita"] . "</td>";
                echo "<td>" . $rowDoc["Nombre"] . "</td>";
                echo "<td>" . $row["Fecha_Cita"] . "</td>";
                echo "<td>" . $row["Hora"] . "</td>";
                echo "<td>" . $row["Estado_Cita"] . "</td>";
                echo "<td>" . $rowCuestionario["Sintomas"] . "</td>";
                echo "<td>" . $rowCuestionario["Alergias"] . "</td>";
                echo "<td>" . $rowCuestionario["Medicamentos_Actuales"] . "</td>";
                echo "<td>" . $rowCuestionario["Historial_Medico"] . "</td>";
                echo "<td>" . $rowCuestionario["Lugar_Dolor"] . "</td>";

                echo "<td >
                        <a class='btn btn-primary' href='actualizarCita.php?id=" . $row["idCita"] . "' >Modificar</a>
                      </td>  
                      <td >
                        <a href='#' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminaModal' data-bs-id='" . $row["idCita"] . "' >Eliminar</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </table>
    
    </div>

    <?php include 'modalEliminar.php'?>

    

    

    

</div>
    
    <script>

        let eliminaModal = document.getElementById('eliminaModal')

        eliminaModal.addEventListener('shown.bs.modal', event =>{

            let button= event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id



        })

    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
   

    
</body>
</html>
