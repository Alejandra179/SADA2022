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
            <button type="submit">Buscar</button>
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
                            $label= array();
                            $temperaturas=array();
                            while($row = mysqli_fetch_assoc($resultado)){
                                array_push($label,$row['fecha_actual']);
                                array_push($temperaturas,$row['Temperatura']);
                                ?>
                            <tr>
                            <td scope="row"><input type="checkbox"></td>
                            <td><?php echo $row['Temperatura'] ?></td>
                            <td><?php echo $row['Humedad'] ?></td>
                            <td><?php echo $row['fecha_actual']?></td>
                            </tr>
                            <?php }?>
                        </tbody>

                    </table>
<?php echo json_encode($label);?>
                </div>
                <div class="col-6">
                    <div>
                    <canvas id="myChart" width="400" height="400"></canvas>
                    </div>

                </div>


        </div>
    </div>
</div>
    
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.esm.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
  const labels = <?php echo json_encode($label)?>

  const data = {
    labels: labels,
    datasets: [{
      label: 'Temperatura',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: <?php echo json_encode($temperaturas)?>,
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>