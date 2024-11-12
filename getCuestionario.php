<?php  include 'Static/connect/db.php'?>
<?php

    $id=$_POST['id'];
    $sql = "SELECT * FROM cuestionario where idCuestionario=$id;";
    $resultado= $conn->query($sql);
    $rows= $resultado->num_rows;

    $cuestionario= [];

    if($rows > 0){

        $cuestionario=$resultado->fetch_Array();


    }


    echo json_encode($cuestionario, JSON_UNESCAPED_UNICODE);



?>