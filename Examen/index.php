<?php
require('db.php');

//obtener usuarios
$sqlUsers = "call obtenerUsuarios();";
$usersCount = 0;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($uResult = mysqli_query($conn, $sqlUsers)) {
    while ($row = mysqli_fetch_assoc($uResult)) {
        $arrUsuarios[$usersCount][0] = $row['Id'];
        $arrUsuarios[$usersCount][1] = $row['Nombre'];
        $usersCount++;
    }
} else {
    echo "error obteniendo usuarios";
}

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

function addRegistro($conn, $idUsuario, $idEstado)
{
    $consulta = "call AgregarRegistro(" . $idUsuario . ", " . $idEstado . ");";
    mysqli_query($conn, $consulta);
}

// POSTS
if (isset($_POST['submit_name'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $addName = 'call AgregarUsuario("' . $_POST['name_input'] . '", 1);';
    if (mysqli_query($conn, $addName)) {
        echo '<script>loadUsers();</script>';
    } else {
        echo '<script language="javascript">alert("Error agregando a ' . $_POST['name_input'] . '");</script>';
    }
}

if (isset($_POST['submit_registro'])) {
    $opcion = $_POST['opcion_estado'];
    $usr = $_POST['opcion_usuario'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $registro = 'call AgregarRegistro("' . $usr . '", ' . $opcion . ');';
    if (mysqli_query($conn, $registro)) {
        echo '<script>loadUsers();</script>';
    } else {
        echo '<script language="javascript">alert("Error agregando registro");</script>';
    }
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

    <script type="text/javascript" src='scripts.js'> </script>
</head>

<style>
    .modal-content {
        height: 500px;
    }

    h4 {
        padding-bottom: 50px;
    }

    .modal-form-row {}
</style>

<body>
    <header></header>

    <main>

        <div class="navbar-fixed">
            <nav>
                <div class="blue darken-1 nav-wrapper">
                    <a href="index.php" class="brand-logo"><acronym title="Desarrollo de aplicaciones web y Bases de datos">Segundo parcial: DAW-BD</acronym></a>
                    <ul id="nav-mobile" class="right">
                        <li><a href="consultas.php">Consultas</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="container">

            <a class="right btn-large waves-effect waves-light red btn-floating btn modal-trigger" href="#modal2"><i class="material-icons">add</i></a>

            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>Crear Registro</h4>
                    <form action="" method="post">
                        <div class="input-field col s12">
                            <select name="opcion_usuario">
                                <option value="" disabled selected>Escoja el zombie</option>
                                <?php
                                for ($i = 0; $i <= $usersCount; $i++) {
                                    echo "<option value = '" . $arrUsuarios[$i][0] . "'> " . $arrUsuarios[$i][1] . "</option>";
                                }
                                ?>
                            </select>

                            <select name="opcion_estado">
                                <option value="" disabled selected>Escoja el estado</option>
                                <?php
                                for ($i = 0; $i < $statesCount; $i++) {
                                    echo "<option value = '" . $arrEstados[$i][0] . "'> " . $arrEstados[$i][1] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn waves-effect waves-light" type="submit" name="submit_registro">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Modal Structure -->
            <div id="modal2" class="modal">
                <div class="modal-content">
                    <h4>Añadir Zombie</h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="nombre" id="first_name" type="text" class="validate" name="name_input">
                                <label for="first_name">Nombre del Zombie</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s3">
                                <button class="btn waves-effect waves-light" type="submit" name="submit_name">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABLA -->
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Zombie</th>
                        <th>Registros</th>
                    </tr>
                </thead>
                <tbody id="tabla_usuarios">
                    <script>
                        loadUsers();
                    </script>
                </tbody>
            </table>

        </div>
    </main>


    <footer class="blue darken-1 page-footer">
        <div class="container">
            <p class="grey-text text-lighten-4">Powered by <a href="http://materializecss.com/" target="_blank" class="white-text text-lighten-4">Materialize</a>.</p>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2020 Escuela de Ingeniería y Ciencias - Tecnológico de Monterrey en Querétaro.
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.modal').modal({
                ready: function(modal, trigger) {
                    modal.find('#trigger-id').text(trigger.attr('id'));
                    modal.find('#attr-data-id').text(trigger.data('id'));
                }
            });
            $('select').formSelect();
        });
        $(document).ready(function() {
            $('.modal').modal();
        });
        $(document).ready(function() {
            $('.modal2').modal();
        });
    </script>
</body>

</html>