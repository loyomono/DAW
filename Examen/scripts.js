function loadUsers() {
    // request
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tabla_usuarios").innerHTML = this.responseText;
        } else {
            document.getElementById("tabla_usuarios").innerHTML = "error";
        }
    };

    xhttp.open("POST", "zombies.php", true);
    xhttp.send();
}

function loadRegistros(/*idElemeto, idUsuario*/) {
    // request
    var xhttp = new XMLHttpRequest();
    var params = 'uid=' + idUsuario;

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(idElemeto).innerHTML = this.responseText;
        } else {
            document.getElementById(idElemeto).innerHTML = "error";
        }
    };

    xhttp.open("POST", "getTodos.php", true);
    xhttp.send(params);
}