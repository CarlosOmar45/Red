CREATE TABLE Usuario (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellidos VARCHAR(100),
    password VARCHAR(255),
    codigo INT,
    correo VARCHAR(100),
    fecha_nacimiento DATE,
    carrera ENUM('Licenciatura en Física','Licenciatura en Matemáticas','Licenciatura en Química','Químico Farmacéutico Biólogo','Ingeniería en Ciencia de Materiales','Ingeniería Civil','Ingeniería en Alimentos y Biotecnología','Ingeniería en Topografía Geomática','Ingeniería Industrial','Ingeniería Mecánica Eléctrica','Ingeniería Química','Ingeniería en Logística y Transporte','Ingeniería Informática','Ingeniería Biomédica','Ingeniería en Computación','Ingeniería en Electromovilidad y Autotrónica','Ingeniería en Electrónica y Sistemas Inteligentes','Ingeniería Fotónica','Ingeniería en Mecatrónica Inteligente','Ingeniería Robótica'),
    role ENUM('Usuario', 'Administrador') DEFAULT 'Usuario'
);

CREATE TABLE Lugar (
    lugar_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    nombre VARCHAR(100),
    calle VARCHAR(100),
    no_exterior INT,
    tipo_establecimiento VARCHAR(50),
    descripcion TEXT,
    estrellas_prom DECIMAL(2,1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,   

    FOREIGN KEY (user_id) REFERENCES Usuario(user_id)
    
);
CREATE TABLE Comentario (
    comentario_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    lugar_id INT,
    comentario TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id),
    FOREIGN KEY (lugar_id) REFERENCES Lugar(lugar_id)
) ENGINE=InnoDB;
CREATE TABLE Likes (
    like_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    lugar_id INT,
    comentario_id INT,
    item_type ENUM('lugar', 'comentario'),
    like_value BOOLEAN,
    estrellas INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id),
    FOREIGN KEY (lugar_id) REFERENCES Lugar(lugar_id),
    FOREIGN KEY (comentario_id) REFERENCES Comentario(comentario_id)
) ENGINE=InnoDB;





REATE TABLE Usuario (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellidos VARCHAR(100),
    password VARCHAR(255),
    codigo INT,
    correo VARCHAR(100),
    fecha_nacimiento DATE,
    carrera ENUM('Licenciatura en Física','Licenciatura en Matemáticas','Licenciatura en Química','Químico Farmacéutico Biólogo','Ingeniería en Ciencia de Materiales','Ingeniería Civil','Ingeniería en Alimentos y Biotecnología','Ingeniería en Topografía Geomática','Ingeniería Industrial','Ingeniería Mecánica Eléctrica','Ingeniería Química','Ingeniería en Logística y Transporte','Ingeniería Informática','Ingeniería Biomédica','Ingeniería en Computación','Ingeniería en Electromovilidad y Autotrónica','Ingeniería en Electrónica y Sistemas Inteligentes','Ingeniería Fotónica','Ingeniería en Mecatrónica Inteligente','Ingeniería Robótica'),
    role ENUM('Usuario', 'Administrador') DEFAULT 'Usuario'
);

CREATE TABLE Lugar (
    lugar_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    nombre VARCHAR(100),
    calle VARCHAR(100),
    no_exterior INT,
    tipo_establecimiento VARCHAR(50),
    descripcion TEXT,
    estrellas_prom DECIMAL(2,1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,   

    FOREIGN KEY (user_id) REFERENCES Usuario(user_id)
    
);
CREATE TABLE Comentario (
    comentario_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    lugar_id INT,
    comentario TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id),
    FOREIGN KEY (lugar_id) REFERENCES Lugar(lugar_id)
) ENGINE=InnoDB;
CREATE TABLE Likes (
    like_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    lugar_id INT,
    comentario_id INT,
    item_type ENUM('lugar', 'comentario'),
    like_value BOOLEAN,
    estrellas INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Usuario(user_id),
    FOREIGN KEY (lugar_id) REFERENCES Lugar(lugar_id),
    FOREIGN KEY (comentario_id) REFERENCES Comentario(comentario_id)
) ENGINE=InnoDB;
