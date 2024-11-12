<?php  include 'Static/connect/db.php'?>
<?php
    session_start();
    $Tipo = $_SESSION['Tipo'];
    $id=$_SESSION['idUsuario'];

    if(isset($_SESSION['Tipo'] ) && $Tipo=="Doctor"){
        echo "<h1> Iniciaste sesion como: " .$id. "</h1>";
        ?>
        <a href = "logout.php" > Cerrar Sesion </a>
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


    
    
    </div>

    <?php include 'modalPaciente.php'?>
    <?php include 'modalReceta.php'?>

    

    

    

</div>
    
    <script src="Static/js/consultaCitaDoctor.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
   

    
</body>
</html>
