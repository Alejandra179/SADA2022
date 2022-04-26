<?php
include 'conexion.php';
if($con){

    function TraerDatosGrafico(){
        $sql = "consulta";
        $arreglo = array();
        if($consulta = $this->$con->$con->query($sql)){
            while($consulta_VU = mysqli_fetch_array($consulta)){
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->$con->cerrar();
        }
    }
}

?>