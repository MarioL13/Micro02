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

-- Tabla de proyectos (añadiendo la columna state como BOOLEAN)
CREATE TABLE projects (
                          id_project      INT AUTO_INCREMENT PRIMARY KEY,
                          title           VARCHAR(50),
                          description     VARCHAR(300),
                          creation_date   DATE,
                          limit_date      DATE,
                          state           TINYINT(1) DEFAULT 1 -- 1 = activo, 0 = inactivo
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
                       icon            VARCHAR(200)
);

-- Tabla intermedia usuarios-proyectos (con rol y nota)
CREATE TABLE user_projects (
                               id_user         INT,
                               id_project      INT,
                               grade           FLOAT,
                               PRIMARY KEY (id_user, id_project),
                               FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
                               FOREIGN KEY (id_project) REFERENCES projects(id_project) ON DELETE CASCADE
);

-- Tabla intermedia proyectos-ítems (con porcentaje y nota)
CREATE TABLE project_items (
                               id_project      INT,
                               id_item         INT,
                               percentage      FLOAT NOT NULL,
                               grade           FLOAT,
                               PRIMARY KEY (id_project, id_item),
                               FOREIGN KEY (id_project) REFERENCES projects(id_project) ON DELETE CASCADE,
                               FOREIGN KEY (id_item) REFERENCES items(id_item) ON DELETE CASCADE
);

-- Tabla intermedia actividades-ítems (con porcentaje y nota)
CREATE TABLE activity_items (
                                id_activity     INT,
                                id_item         INT,
                                percentage      FLOAT NOT NULL,
                                grade           FLOAT,
                                PRIMARY KEY (id_activity, id_item),
                                FOREIGN KEY (id_activity) REFERENCES activities(id_activity) ON DELETE CASCADE,
                                FOREIGN KEY (id_item) REFERENCES items(id_item) ON DELETE CASCADE
);

-- Nueva tabla: Notas por ítem, usuario y actividad
CREATE TABLE activity_item_grades (
                                      id_activity     INT,
                                      id_item         INT,
                                      id_user         INT,
                                      grade           FLOAT,
                                      PRIMARY KEY (id_activity, id_item, id_user),
                                      FOREIGN KEY (id_activity) REFERENCES activities(id_activity) ON DELETE CASCADE,
                                      FOREIGN KEY (id_item) REFERENCES items(id_item) ON DELETE CASCADE,
                                      FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Insert de un usuario profesor
INSERT INTO users (name, surname, email, password, birthdate, state, dni, is_profesor, image, creation_date)
VALUES
    ('Profesor', 'Demo', 'p@p.com', '$2y$12$e7y7l3ik9nRqxucBHbJh8eo80rYAn89R7LexEf8PKBSca0c7HErsi', NULL, 1, NULL, 1, NULL, CURDATE());
