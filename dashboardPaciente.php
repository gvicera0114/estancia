<?php
    session_start();
    $Tipo = $_SESSION['Tipo'];
    $id= $_SESSION['idUsuarioPa'];

    if(isset($_SESSION['Tipo'] ) && $Tipo=="Paciente"){
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido paciente</h1>

</body>
</html>