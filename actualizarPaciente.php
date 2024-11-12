<?php  include 'Static/connect/db.php'?>
<?php


        if(isset($_GET['id'])){

            $id=$_GET['id'];
            $sql= "select * from paciente where idPaciente=$id;";

            $resul=mysqli_query($conn,$sql);

            if(mysqli_num_rows($resul)==1){

                $row=mysqli_fetch_array($resul);
            
                $nombre= $row['Nombre'];
                $Apaterno= $row['A_Paterno'];
                $Amaterno= $row['A_Materno'];
                $Genero= $row['Genero'];
                $Matricula= $row['Matricula'];
                $Contrasenia= $row['Contrasenia'];
                $FechaNac= $row['Fecha_Nacimiento'];
                $EstadoCivil= $row['Estado_Civil'];
                // echo $nombre . "|" . $precio;


            }

        }


        if(isset($_POST['actualizarPaciente'])){

            
            $nombre = $_POST["nombrePaciente"];
            $Apaterno= $_POST['apellidoPaternoPaciente'];
            $Amaterno= $_POST['apellidoMaternoPaciente'];
            $genero=$_POST["Genero"];
            $matricula=$_POST["matricula"];
            $contrasenia=$_POST["contrasenia"];
            $fecha=$_POST["fechaNacimiento"];
            $estadoCivil=$_POST["EstadoCivil"];
                
            
            $sql= "UPDATE paciente SET nombre='$nombre' , A_Paterno='$Apaterno', A_Materno='$Amaterno', Genero='$genero',
            Matricula='$Matricula', Contrasenia='$contrasenia', Fecha_Nacimiento='$fecha',
            Estado_Civil='$estadoCivil'
            where idPaciente='$id';";

            mysqli_query($conn,$sql);
            header("LOCATION: consultarUsuarios.php");


        }





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Tu archivo de estilos personalizado -->
    <link rel="stylesheet" href="Static/css/styles.css">


</head>
<body>

            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="login.php">
                        <img src="Static/img/upemor_logo.png" alt="Bootstrap" width="50" >
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        
                        <a class="nav-link" href="#">Perfil</a>
                        <a class="nav-link" href="#">Cerrar sesion</a>
                        
                    </div>
                    </div>
                </div>
            </nav>

            <div class="container mt-5">

            <h2 style="text-align: center;">Actualizar datos del doctor</h2>

            <form id="formPaciente" action="actualizarPaciente.php?id=<?php echo $_GET['id']; ?>" class="tipo" method="post">
            <div  id="paciente" >
                <div class="mb-3">
                    <label for="nombrePaciente" class="form-label">Nombre</label>
                    <input
                    type="text"
                    class="form-control"
                    id="nombrePaciente"
                    name="nombrePaciente"
                    value="<?php echo $nombre;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="apellidoPaternoPaciente" class="form-label">Apellido paterno</label>
                    <input
                    type="text"
                    class="form-control"
                    id="apellidoPaternoPaciente"
                    name="apellidoPaternoPaciente"
                    value="<?php echo $Apaterno;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="apellidoMaternoPaciente" class="form-label">Apellido materno</label>
                    <input
                    type="text"
                    class="form-control"
                    id="apellidoMaternoPaciente"
                    name="apellidoMaternoPaciente"
                    value="<?php echo $Amaterno;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="generoPaciente" class="form-label">Género (Masculino/Femenino)</label>
                    <input
                    type="text"
                    class="form-control"
                    id="Genero"
                    name="Genero"
                    value="<?php echo $Genero;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="matricula" class="form-label">Matricula</label>
                    <input
                    type="text"
                    class="form-control"
                    id="matricula"
                    name="matricula"
                    value="<?php echo $Matricula;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="estadoCivil" class="form-label">Estado civil(Soltero(a)/Casado(a)/Divorciado(a))</label>
                    <input
                    type="text"
                    class="form-control"
                    id="EstadoCivil"
                    name="EstadoCivil"
                    value="<?php echo $EstadoCivil;?>"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="fechaNacimiento" class="form-label" >Fecha de nacimiento</label>
                    <input
                    type="date"
                    class="form-control"
                    id="fechaNacimiento"
                    name="fechaNacimiento"
                    value="<?php echo $FechaNac;?>"
                    onchange="obtenerFecha(this)"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                    type="text"
                    class="form-control"
                    id="contrasenia"
                    name="contrasenia"
                    value="<?php echo $Contrasenia;?>"
                    required
                    />
                </div>

                <button name="actualizarPaciente" type="submit" class="btn-Registrar btn btn-success">
                Registrar
                </button>
                <button type="reset" class="btn-Cancelar btn btn-danger">
                Cancelar
                </button>

                

            </div>

        </form>

        </div>


        <script src="Static/js/formulario.js"></script>
    
</body>
</html>