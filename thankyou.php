<?php
    $connect = mysqli_connect('localhost', 'root', '', 'pruebaphp');


    $id='';
    $departamento = '';
    $cliente = '';
    $empleadoescogidoaleatorio='';
  
    $query =    'select id, nombrecliente, departamento,nombreempleado
                    from contact  
                    where nombrecliente="'. addslashes($_GET["clientepasado"]) .'" order by id desc LIMIT 1';
        $consulta=mysqli_query($connect, $query);
          if (mysqli_num_rows($consulta) > 0){
            while($fila = mysqli_fetch_assoc($consulta)){
                $id = $fila["id"];
                $cliente = $fila["nombrecliente"];
                $departamento = $fila["departamento"];
                $empleadoescogidoaleatorio = $fila["nombreempleado"];


            }
          }
          else {
            die("Error: no hay datos en la tabla");
          }

    mysqli_close($connect);
?>

<!doctype html>
<html>
    <head>
        <title>
            DESPEDIDA 1
        </title>
    </head>
    <body>
    
        <h1>Buenas tardes, señor <?php echo $cliente; ?></h1>
        <h2>Gracias por confiar en CONSULTORA SAS. 
            Su Solicitud ha sido recibida y se ha abierto un ticket con id número <?php echo $id; ?> desde 
            el departamento de <?php echo $departamento; ?> y será atendido por <?php echo $empleadoescogidoaleatorio; ?>.  </h2>


    </body>
</html>
