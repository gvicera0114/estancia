<?php include 'Static/connect/db.php'?>
<?php

    session_start();

    $user = $_POST['usuario'];
    $password = $_POST['contrasenia'];
    $sqlDoctor = "SELECT * FROM doctor WHERE Usuario = '$user' and Contrasenia = '$password';";
    $sqlPaciente = "SELECT * from paciente where Matricula='$user' and  Contrasenia = '$password';";
    $sqlAdmi = "SELECT * from administrador where Usuario='$user' and  Contrasenia = '$password';";



    $result1 = mysqli_query($conn,$sqlDoctor);
    $result2 = mysqli_query($conn,$sqlPaciente);
    $result3 = mysqli_query($conn,$sqlAdmi);

    


    $row_cnt1 = $result1->num_rows;
    $row_cnt2 = $result2->num_rows;
    $row_cnt3 = $result3->num_rows;
    sleep(2);



    if ($row_cnt1 > 0){
        $row=mysqli_fetch_array($result1);

        $_SESSION['Tipo']= "Doctor";
        
        $_SESSION['idUsuario']= $row['idDoctor'];


        header("Location: dashboardDoctor.php");
    }else if($row_cnt2 > 0){
        $row=mysqli_fetch_array($result2);
        $_SESSION['Tipo']= "Paciente";
        $_SESSION['idUsuarioPa']= $row['idPaciente'];
        header("Location: dashboardPaciente.php");
        
    }else if ($row_cnt3 > 0){
        $row=mysqli_fetch_array($result3);
        $_SESSION['Tipo']= "admin";
        $_SESSION['idUsuario']= $row['idAdministrador'];

        header("Location: registro.php");

    }else
    {
        
        header("Location: login.php?error=AccessDenied");
    }



    
?>