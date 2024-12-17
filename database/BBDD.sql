-- Elimina la base de datos si existe y crea una nueva
DROP DATABASE IF EXISTS micro02;
CREATE DATABASE micro02;

USE micro02;

-- Tabla de usuarios
CREATE TABLE users (
                       id_user         INT AUTO_INCREMENT PRIMARY KEY,
                       name            VARCHAR(50),
                       surname         VARCHAR(100),
                       email           VARCHAR(100),
                       password        VARCHAR(250),
                       birthdate       DATE,
                       state           TINYINT(1),
                       dni             VARCHAR(9),
                       is_profesor     TINYINT(1),
                       image           VARCHAR(100),
                       creation_date   DATE
);

-- Tabla de proyectos
CREATE TABLE projects (
                          id_project      INT AUTO_INCREMENT PRIMARY KEY,
                          title           VARCHAR(50),
                          description     VARCHAR(300),
                          creation_date   DATE,
                          limit_date      DATE
);

-- Tabla de actividades
CREATE TABLE activities (
                            id_activity     INT AUTO_INCREMENT PRIMARY KEY,
                            id_project      INT,
                            title           VARCHAR(50),
                            state           INT,
                            creation_date   DATE,
                            limit_date      DATE,
                            description     VARCHAR(300),
                            FOREIGN KEY (id_project) REFERENCES projects(id_project) ON DELETE CASCADE
);

-- Tabla de ítems
CREATE TABLE items (
                       id_item         INT AUTO_INCREMENT PRIMARY KEY,
                       title           VARCHAR(50),
                       description     VARCHAR(200),
                       icon            VARCHAR(20)
);

-- Tabla intermedia usuarios-proyectos (con rol y nota)
CREATE TABLE user_projects (
                               id_user         INT,
                               id_project      INT,
                               grade           FLOAT,          -- Nota final asignada al proyecto para el usuario
                               PRIMARY KEY (id_user, id_project),
                               FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
                               FOREIGN KEY (id_project) REFERENCES projects(id_project) ON DELETE CASCADE
);

-- Tabla intermedia proyectos-ítems (con porcentaje y nota)
CREATE TABLE project_items (
                               id_project      INT,
                               id_item         INT,
                               percentage      FLOAT NOT NULL, -- % que vale en la nota final
                               grade           FLOAT,         -- Nota asignada al ítem
                               PRIMARY KEY (id_project, id_item),
                               FOREIGN KEY (id_project) REFERENCES projects(id_project) ON DELETE CASCADE,
                               FOREIGN KEY (id_item) REFERENCES items(id_item) ON DELETE CASCADE
);

-- Tabla intermedia actividades-ítems (con porcentaje y nota)
CREATE TABLE activity_items (
                                id_activity     INT,
                                id_item         INT,
                                percentage      FLOAT NOT NULL, -- % que vale en la nota final
                                grade           FLOAT,         -- Nota asignada al ítem en la actividad
                                PRIMARY KEY (id_activity, id_item),
                                FOREIGN KEY (id_activity) REFERENCES activities(id_activity) ON DELETE CASCADE,
                                FOREIGN KEY (id_item) REFERENCES items(id_item) ON DELETE CASCADE
);

-- Tabla intermedia actividades (con porcentaje y nota para el usuario)
CREATE TABLE activity_grades (
                                 id_activity     INT,
                                 id_user         INT,
                                 grade           FLOAT,         -- Nota asignada a la actividad para el usuario
                                 PRIMARY KEY (id_activity, id_user),
                                 FOREIGN KEY (id_activity) REFERENCES activities(id_activity) ON DELETE CASCADE,
                                 FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Consulta para verificar las tablas creadas
SHOW TABLES;

INSERT INTO users (name, surname, email, password, birthdate, state, dni, is_profesor, image, creation_date)
VALUES
    ('Juan', 'Pérez', 'juan.perez@example.com', 'password123', '2000-05-15', 1, '12345678A', 0, 'juan.jpg', '2024-12-05'),
    ('Ana', 'López', 'ana.lopez@example.com', 'password456', '1999-08-20', 1, '87654321B', 0, 'ana.jpg', '2024-12-05'),
    ('Luis', 'Martínez', 'luis.martinez@example.com', 'password789', '2001-02-10', 1, '11223344C', 0, 'luis.jpg', '2024-12-05');

-- Inserts en la tabla de proyectos (dos proyectos)
INSERT INTO projects (title, description, creation_date, limit_date)
VALUES
    ('Proyecto Innovador', 'Un proyecto sobre innovación tecnológica.', '2024-12-01', '2025-01-15'),
    ('Proyecto Sostenible', 'Proyecto enfocado en la sostenibilidad ambiental.', '2024-12-02', '2025-01-20');

-- Inserts en la tabla de actividades (tres actividades)
INSERT INTO activities (id_project, title, state, creation_date, limit_date, description)
VALUES
    (1, 'Investigar Innovaciones', 1, '2024-12-03', '2024-12-10', 'Actividad para investigar innovaciones recientes.'),
    (1, 'Desarrollar Prototipo', 0, '2024-12-04', '2024-12-15', 'Crear un prototipo basado en la investigación.'),
    (2, 'Análisis Ambiental', 1, '2024-12-05', '2024-12-12', 'Evaluar impactos ambientales de proyectos similares.');

-- Inserts en la tabla de ítems (cuatro ítems)
INSERT INTO items (title, description, icon)
VALUES
    ('Documentación', 'Crear y organizar documentos.', 'doc-icon'),
    ('Investigación', 'Buscar información relevante.', 'search-icon'),
    ('Desarrollo', 'Implementar soluciones técnicas.', 'code-icon'),
    ('Presentación', 'Preparar diapositivas y exposiciones.', 'presentation-icon');


INSERT INTO user_projects (id_user, id_project, grade)
VALUES
    (1, 1, NULL), -- Juan participa en el Proyecto Innovador
    (2, 1, NULL), -- Ana participa en el Proyecto Innovador
    (3, 2, NULL), -- Luis participa en el Proyecto Sostenible
    (3, 1, NULL); -- Luis participa en el Proyecto Innovador

INSERT INTO activity_items (id_activity, id_item, percentage, grade)
VALUES
    (1, 1, 50, NULL), -- Documentación vale 50% en la actividad de Investigar Innovaciones
    (1, 2, 50, NULL), -- Investigación vale 50% en la actividad de Investigar Innovaciones
    (2, 3, 100, NULL), -- Desarrollo vale 100% en la actividad de Desarrollar Prototipo
    (3, 4, 100, NULL); -- Presentación vale 100% en la actividad de Análisis Ambiental

INSERT INTO project_items (id_project, id_item, percentage, grade)
VALUES
    (1, 1, 40, NULL), -- Documentación vale 40% en el Proyecto Innovador
    (1, 2, 60, NULL), -- Investigación vale 60% en el Proyecto Innovador
    (2, 3, 50, NULL), -- Desarrollo vale 50% en el Proyecto Sostenible
    (2, 4, 50, NULL); -- Presentación vale 50% en el Proyecto Sostenible

INSERT INTO activity_grades (id_activity, id_user, grade)
VALUES
    (1, 1, NULL), -- Juan tiene el 33.33% de nota en Investigar Innovaciones
    (1, 2, NULL), -- Ana tiene el 33.33% de nota en Investigar Innovaciones
    (1, 3, NULL), -- Luis tiene el 33.33% de nota en Investigar Innovaciones
    (2, 1, NULL),   -- Juan tiene el 100% de nota en Desarrollar Prototipo
    (3, 3, NULL);   -- Luis tiene el 100% de nota en Análisis Ambiental

SELECT * FROM activity_grades;
