<?php
include 'conexion.php';
if($con){
    if(empty($_POST['fecha_desde'])){
        $datos = "SELECT * FROM Tb_DHT22 ORDER BY Tb_DHT22.fecha_actual DESC LIMIT 100";
    }else{
        $fecha_desde = $_POST['fecha_desde'];
        $fecha_hasta = $_POST['fecha_hasta'];
        $datos ="SELECT * FROM `Tb_DHT22` where fecha_actual BETWEEN '$fecha_desde' AND '$fecha_hasta' ORDER BY `Tb_DHT22`.`fecha_actual` DESC";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="mostrar.php" method="POST">
            <input type="date" name="fecha_desde">
            <label>Fecha Desde</label>
            <input type="date" name="fecha_hasta">
            <label>Fecha Hasta</label>
        </form>
        <div class="container">
            <div class="d-flex row">
               
                    <div class="col-6">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                            <th scope="col">Temperatura</th>
                            <th scope="col">Humedad</th>
                            <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $resultado = mysqli_query($con,$datos);
                            while($row = mysqli_fetch_assoc($resultado)){?>
                            <tr>
                            <td scope="row"><?php echo $row['id_registro'] ?></td>
                            <td><?php echo $row['Temperatura'] ?></td>
                            <td><?php echo $row['Humedad'] ?></td>
                            <td><?php echo $row['fecha_actual']?></td>
                            </tr>
                            <?php }?>
                        </tbody>

                    </table>

                </div>


        </div>
    </div>
</div>
    
</body>
</html>