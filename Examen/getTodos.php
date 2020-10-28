  
<?php
require('db.php');

$uid = $_POST['uid'];

function getTodos($conn, $idUsuario)
{
    //obtener zombies
    $res = "";
    $sqlUsers = "call obtenerRegistrosPorUsuario(" . $idUsuario . ");";
    if ($uResult = mysqli_query($conn, $sqlUsers)) {
        while ($row = mysqli_fetch_assoc($uResult)) {
            $res .= $row['Estado'] . " " . $row['FechaHora'] . "<br>";
        }
    } else {
        $res = "error obteniendo registro";
    }
    return $res;
}

$conn = new mysqli($servername, $username, $password, $dbname);
echo getTodos($conn, $uid);

?>