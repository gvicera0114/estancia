<?php  include 'static/connect/db.php'?>
<?php

        if(isset($_GET['id'])){
            
            $ID= $_GET['id'];
            $delete= "delete from doctor where idDoctor=$ID;";
            $execute = mysqli_query($conn,$delete);
            
            header("Location: consultarUsuarios.php");


        }

?>