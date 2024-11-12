<?php  include 'static/connect/db.php'?>
<?php

        if(isset($_GET['id'])){
            
            $ID= $_GET['id'];
            $delete= "delete from paciente where idPaciente=$ID;";
            $execute = mysqli_query($conn,$delete);
            header("Location: consultarUsuarios.php");
            
            


        }

?>