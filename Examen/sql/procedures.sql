DELIMITER $$
CREATE PROCEDURE AgregarEstado(
    IN nm VARCHAR(50)
)
BEGIN
    INSERT INTO Estado(Nombre) VALUES (nm);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE AgregarUsuario (
    IN nm VARCHAR(50), 
    IN estado INT
)
BEGIN
    INSERT INTO Usuario(Nombre, Id_Estado) VALUES (nm, estado);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE AgregarRegistro(
    IN usuario INT, 
    IN estado INT)
BEGIN
    INSERT INTO Registros(Id_Usuario, Id_Estado) VALUES (usuario, estado);
    UPDATE Usuario SET Id_Estado = estado WHERE Id = usuario;
END $$
DELIMITER ;

--obtener
DELIMITER $$
CREATE PROCEDURE obtenerEstados()
BEGIN
    SELECT * FROM Estado;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerUsuarios()
BEGIN
    SELECT * FROM Usuario;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerRegistros()
BEGIN
    SELECT * FROM Registros
    ORDER BY FechaHora DESC;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerCantidadZombies()
BEGIN
    SELECT COUNT(Id) FROM Usuario;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerCantidadZombiesPorEstado()
BEGIN
    SELECT E.Nombre, COUNT(U.Id) 
    FROM Usuario U, Estado E
    Where U.Id_Estado = E.id
    GROUP BY U.Id_Estado, E.Id;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerCantidadZombiesPorBusqueda(
    IN estado INT
)
BEGIN
    SELECT COUNT(Id)
    FROM Usuario
    WHERE Id_Estado = estado;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerRegistrosPorBusqueda(
    IN estado INT
)
BEGIN
    SELECT U.Nombre, R.FechaHora, E.Nombre
    FROM Registros R, Usuario U, Estado E
    WHERE R.Id_Estado = estado AND R.Id_Estado = E.Id AND R.Id_Usuario = U.Id;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE obtenerRegistrosPorUsuario(
    IN usuario INT
)
BEGIN
    SELECT U.Nombre, R.FechaHora, E.Nombre Estado
    FROM Registros R, Usuario U, Estado E
    WHERE R.Id_Usuario = usuario AND R.Id_Estado = E.Id AND R.Id_Usuario = U.Id;
END $$
DELIMITER ;