<?php
require('db.php');

// obtener estados
$sql = "call obtenerEstados();";
$statesCount = 0;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $arrEstados[$statesCount][0] = $row['Id'];
        $arrEstados[$statesCount][1] = $row['Nombre'];
        $statesCount++;
    }
} else {
    echo "error obteniendo estados";
}

// POSTS
if (isset($_POST['todos_registros'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}

if (isset($_POST['zombiesPorEstado'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}

if (isset($_POST['zombiesEnInfeccion'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}

if (isset($_POST['zombiesEnDesorientacion'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}

if (isset($_POST['zombiesEnViolencia'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}

if (isset($_POST['zombiesEnDesmayo'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}

if (isset($_POST['zombiesEnTransformacion'])) {
    // ir a todos los registros
    header("Location: http://antiphrastical-fres.000webhostapp.com/todos_zombies.php");
}


?>

<!DOCTYPE html>
<html>
<html lang="es">

<head>
    <!--Import materialize.css-->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <title>Examen de segundo parcial</title>

    <script type="text/javascript" src='funciones.js'> </script>
</head>

<body>
    
    <div class="navbar-fixed">
            <nav>
                <div class="blue darken-1 nav-wrapper">
                    <a href="index.php" class="brand-logo"><acronym title="Desarrollo de aplicaciones web y Bases de datos">Segundo parcial: DAW-BD</acronym></a>
                    <ul id="nav-mobile" class="right">
                        <li><a href="index.php">Inicio</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    
    <div class="container">
        <br>
        <form method="POST">
            <button class="btn waves-effect waves-light" type="submit" name="todos_registros">
                Todos los registros
            </button>
            <br><br>
            <button class="btn waves-effect waves-light" type="submit" name="zombiesPorEstado">
                Zombies por estado
            </button>
            <br><br>
            <?php
            for ($i = 0; $i < $statesCount; $i++) {
                echo '
                    <button  class="btn waves-effect waves-light" type="submit" name="consulta'.$arrEstados[$i][0].'">
                        Zombies en '.$arrEstados[$i][1].'
                    </button><br><br>
                ';
            }
            ?>
        </form>
    </div>
</body>

</html>