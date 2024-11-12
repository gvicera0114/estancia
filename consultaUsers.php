<?php  include 'Static/connect/db.php'?>
<?php
        
       

        
        
        $salida = "";
        $sql = "SELECT * from doctor";
        $sql2= "SELECT * from paciente";

        $tipo = isset($_POST['tipo']) ? $conn->real_escape_string($_POST['tipo']) : '';

        if(isset($_POST['consulta'])){

            if($tipo=="doctor"){
                $q= $conn->real_escape_string($_POST['consulta']);

                $sql= "SELECT * from doctor where Nombre LIKE '%" . $q . "%' ";

            }else if($tipo=="paciente"){

                $q= $conn->real_escape_string($_POST['consulta']);

                $sql2= "SELECT * from paciente where Nombre LIKE '%" . $q . "%' ";


            }

        }


        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if (!$result || !$result2) {
            die("Error en la consulta SQL: " . $conn->error);
        }
        

        // Mostrar los resultados
        if ($result->num_rows > 0) {
            
                
                if($tipo=="doctor"){

                    $salida .= "<table class='table  table-bordered border-dark table-striped-columns'>
                    <caption>Lista de usuarios</caption>
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre de usuario</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Genero</th>
                    <th>Cedula</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Telefono</th>
                    <th>Horario de atención inicial</th>
                    <th>Horario de atención final</th>  
                    <th>Fecha ingreso</th>

                    
                    <th>Eliminar</th>
                    <th>Actualizar</th>
                    </tr>
                    </thead>
                    ";

                    while($fila = $result->fetch_assoc()){

                        $salida .= "<tr>
                        
                            <td>".$fila["idDoctor"]."</td>
                            <td>".$fila["Nombre"]."</td>
                            <td>".$fila["A_Paterno"]."</td>
                            <td>".$fila["A_Materno"]."</td>
                            <td>".$fila["Genero"]."</td>
                            <td>".$fila["Cedula"]."</td>
                            <td>".$fila["Usuario"]."</td>
                            <td>".$fila["Contrasenia"]."</td>
                            <td>".$fila["Telefono"]."</td>
                            <td>".$fila["Horario_Atencion_I"]."</td>
                            <td>".$fila["Horario_Atencion_F"]."</td>
                            <td>".$fila["Fecha_Ingreso"]."</td>


                            <th><a href='eliminarDoctor.php?id=" .$fila['idDoctor'] . " ' onclick='return confirmacion()'>Eliminar</a> </th> 
                            <th><a href='actualizarDoctor.php?id=" . $fila['idDoctor'] . "'>Modificar</a></th>

                            </tr>
                        
                        ";

                    }


                    $salida .= "</table>"; 
                }else if($tipo=="paciente"){

                    
                    
                        $salida .= "<table class='table table-bordered border-dark table-striped-columns'>
                        <caption>Lista de usuarios</caption>
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Nombre de usuario</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Genero</th>
                        <th>Matricula</th>
                        <th>Contaseña</th>
                        <th>Fecha nacimiento</th>
                        <th>Estado civil</th>
                        

                        <th>Eliminar</th>
                        <th>Actualizar</th>
                        </tr>
                        </thead>
                        ";
    
                        while($fila2 = $result2->fetch_assoc()){
    
                            $salida .= "<tr>
                            
                                <td>".$fila2["idPaciente"]."</td>
                                <td>".$fila2["Nombre"]."</td>
                                <td>".$fila2["A_Paterno"]."</td>
                                <td>".$fila2["A_Materno"]."</td>
                                <td>".$fila2["Genero"]."</td>
                                <td>".$fila2["Matricula"]."</td>
                                <td>".$fila2["Contrasenia"]."</td>
                                <td>".$fila2["Fecha_Nacimiento"]."</td>
                                <td>".$fila2["Estado_Civil"]."</td>
                               
                                
                                <th><a href='eliminarPaciente.php?id=" .$fila2['idPaciente'] . " ' onclick='return confirmacion()'>Eliminar</a> </th> 
                                <th><a href='actualizarPaciente.php?id=" . $fila2['idPaciente'] . "' >Modificar</a></th>
                                </tr>
                            
                            ";
    
                        }


                }


                
            
        } else {
            $salida .= "No hay datos"; 
        }

        // Cerrar conexión
        echo $salida;
        $conn->close();
?>