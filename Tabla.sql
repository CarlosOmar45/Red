CREATE TABLE Usuarios (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombres VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    CorreoE VARCHAR(150) UNIQUE NOT NULL,
    Codigo VARCHAR(9) UNIQUE NOT NULL,
    Contrasena VARCHAR(255) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Carrera VARCHAR(100) NOT NULL
);


-- El insert para la base de datos

INSERT INTO Usuarios (Nombres, Apellidos, CorreoE, Contrasena, Codigo, FechaNacimiento, Carrera) 
VALUES ('Nombre', 'Apellidos', 'CorreoE', 'Contrasena', 'Codigo', '2001-10-25', 'Carrera');

