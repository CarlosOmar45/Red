-- Crear la tabla Lugar
CREATE TABLE Lugar (
    lugar_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    calle VARCHAR(100),
    no_exterior INT,
    tipo_establecimiento VARCHAR(50),
    descripcion TEXT,
    estrellas_prom DECIMAL(3,2)
);

-- Crear la tabla Usuario
CREATE TABLE Usuario (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellidos VARCHAR(100),
    password VARCHAR(255),
    codigo INT,
    fecha_nacimiento DATE,
    carrera INT
);
-- Crear la tabla Lugar_likes
CREATE TABLE Lugar_Likes (
    lugar_id INT,
    user_id INT,
    like BOOLEAN,
    estrellas INT,
    PRIMARY KEY (lugar_id, user_id),
    FOREIGN KEY (lugar_id) REFERENCES Lugar(lugar_id),
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id)
);
-- Crear la tabla Comentario
CREATE TABLE Comentario (
    comentario_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    lugar_id INT,
    comentario TEXT,
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id),
    FOREIGN KEY (lugar_id) REFERENCES Lugar(lugar_id)
);
-- Crear la tabla Comentario_like
CREATE TABLE Comentario_Like (
    comentario_id INT,
    user_id INT,
    PRIMARY KEY (comentario_id, user_id),
    FOREIGN KEY (comentario_id) REFERENCES Comentario(comentario_id),
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id)
);