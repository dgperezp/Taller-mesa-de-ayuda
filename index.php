<?php

$empleados_soporte = array("Andres Lopez", "Ana Soto", "Javier Diaz", "Maria Cardona");
$empleados_facturacion = array("Andres Soto", "Ana Lopez", "Javier Cardona", "Maria Diaz");
$empleados_atencion = array("Andres Cardona", "Ana Diaz", "Javier Lopez", "Maria Soto");

$empleadoescogidoaleatorio = '';

$connect = mysqli_connect('localhost', 'root', '', 'pruebaphp');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
$id=0;

$email_error = '';
$message_error = '';
$departamento_error='';
$cliente_error='';





if (count($_POST)) {
    $errors = 0;

    if ($_POST['email'] == '') {
        $email_error = 'Por Favor Ingrese su Correo';
        $errors++;
    }

    if ($_POST['message'] == '') {
        $message_error = 'Ingrese su mensaje';
        $errors++;
    }

    if ($_POST['cliente'] == '') {
        $cliente_error = 'Ingrese Nombre Cliente';
        $errors++;
    }

    if ($_POST['departamento'] == "atencioncliente") {
        $empleadoescogidoaleatorio = $empleados_atencion[array_rand($empleados_atencion, 1)];      
    }
    if ($_POST['departamento'] == "soportetecnico") {
        $empleadoescogidoaleatorio = $empleados_soporte[array_rand($empleados_soporte, 1)]; 
    }

    if ($_POST['departamento'] == "facturacion") {
        $empleadoescogidoaleatorio = $empleados_facturacion[array_rand($empleados_facturacion, 1)];        
    }

    if ($_POST['departamento'] == 'Seleccione') {
        $departamento_error = 'Ingrese Departamento';
        $errors++;        
    }
    else {
        echo $empleadoescogidoaleatorio;
    }


    if ($errors == 0) {

        $query = 'INSERT INTO contact (
                email,
                message,
                nombrecliente,
                departamento,
                nombreempleado
            ) VALUES (
                "' . addslashes($_POST['email']) . '",
                "' . addslashes($_POST['message']) . '",
                "' . addslashes($_POST['cliente']) . '",
                "' . addslashes($_POST['departamento']) . '",
                "' . addslashes($empleadoescogidoaleatorio) . '"
            )';
        mysqli_query($connect, $query);

      

        $message = 'You have received a contact form submission:
            
Email: ' . $_POST['email'] . '
Message: ' . $_POST['email'];

        mail(
            'poveda.geovanny@hotmail.com',
            'Contact Form Cubmission',
            $message
        );
        
        
        mysqli_close($connect);
        header('Location: thankyou.php?clientepasado='.$cliente );
        



        die();

    }
}

?>
<!doctype html>
<html>

<head>
    <title>Mesa de Ayuda 1 - Consultora SAS </title>
</head>

<body>

    <h1>PHP Contact Form</h1>

    <form method="post" action="">
        <h1>Soporte Tecnico</h1>

        Nombre de Cliente:
        <br>
        <input type="text" name="cliente" value="">
        <?php echo $cliente_error; ?>

        <br>


        Email:
        <br>
        <input type="text" name="email" value="">
        <?php echo $email_error; ?>

        <br>

        <label for="lang">Departamento</label>

        <br>
        <select name="departamento" id="dep">
            <option value="Seleccione">Seleccione</option>
            <option value="atencioncliente">Atencion Cliente</option>
            <option value="soportetecnico">Soporte Tecnico</option>
            <option value="facturacion">Facturacion</option>
        </select>
        <?php echo $departamento_error; ?>

        <br><br>



        Message:
        <br>
        <textarea name="message"></textarea>
        <?php echo $message_error; ?>

        <br><br>

        
        


        <input type="submit" value="Submit">

      
        <br>

       
    </form>

</body>

</html>