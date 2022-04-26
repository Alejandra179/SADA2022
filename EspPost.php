<?php

include'conexion.php';

if ($con) {
    echo "Conexion con base de datos exitosa! ";
    $direccion = $_POST['direccion'];
    $velocidad = $_POST['velocidad'];
       // $temperatura = $_POST['temperatura'];
        //echo "Estación meteorológica";
    //    echo " Temperaura : ".$temperatura;
      //  $humedad = $_POST['humedad'];
        //echo " humedad : ".$humedad;
        date_default_timezone_set('america/argentina/buenos_aires');
        $fecha_actual = date("Y-m-d H:i:s");
        
        $consulta = "INSERT INTO Tb_DHT22(direccion,velocidad_viento, fecha_actual) VALUES ('$direccion','$velocidad','$fecha_actual')";
       
        $resultado = mysqli_query($con, $consulta);
        if ($resultado){
            echo " Registo en base de datos OK! ";
        } else {
            echo " Falla! Registro BD";
        }
        
    }
    
    else {
    echo "Falla! conexion con Base de datos ";   
}


?>