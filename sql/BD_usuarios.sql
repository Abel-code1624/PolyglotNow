CREATE DATABASE PolyglotNow CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE DATABASE PolyglotNow;

CREATE TABLE usuarios (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE,
    contra VARCHAR(255) NOT NULL,
    idioma ENUM('Español', 'English') NOT NULL,
    c_ing BOOLEAN DEFAULT 0,
    c_esp BOOLEAN DEFAULT 0,
    c_fra BOOLEAN DEFAULT 0,
    c_ita BOOLEAN DEFAULT 0,
    c_ale BOOLEAN DEFAULT 0,
    c_rum BOOLEAN DEFAULT 0
);

INSERT INTO `usuarios` (`usuario`, `contra`, `idioma`, `c_ing`, `c_esp`, `c_fra`, `c_ita`, `c_ale`, `c_rum`) VALUES
('Juan José', 'Password1', 'Español', 0, 0, 1, 1, 1, 1),
('Miguel', 'Password3', 'Español', 0, 0, 0, 1, 0, 1),
('Mike', 'Password3', 'English', 0, 0, 0, 1, 1, 1),
('prueba1', 'Password1', 'Español', 1, 0, 1, 0, 0, 0),
('prueba2', 'Password2', 'English', 0, 1, 0, 1, 0, 0),
('todoen', 'Password2', 'English', 0, 1, 1, 1, 1, 1),
('todoes', 'Password1', 'Español', 1, 0, 1, 1, 1, 1);

CREATE TABLE tests (
    num_test VARCHAR(10) PRIMARY KEY,
    nom_test VARCHAR(30)
);

INSERT INTO `tests`(`num_test`,`nom_test`) VALUES
('T1_E1_ES','¡Hola y Adiós!'),
('T1_E2_ES','Palabras Simples'),
('T1_E3_ES','Adjetivos y Adverbios'),
('T1_E4_ES','Examen'),
/*('T2_E1_ES',''),
('T2_E2_ES',''),
('T2_E3_ES',''),
('T2_E4_ES',''),*/
('T1_E1_EN','Hello and Goodbye!'),
('T1_E2_EN','Simple Worlds'),
('T1_E3_EN','Adjectivs & Adverbs'),
('T1_E4_EN','Exam'),
/*('T2_E1_EN',''),
('T2_E2_EN',''),
('T2_E3_EN',''),
('T2_E4_EN',''),*/
('T1_E1_FR','Bonjour et Au revoir!'),
('T1_E2_FR','Mots Simples'),
('T1_E3_FR','Adjectifs et Adverbes'),
('T1_E4_FR','Examen'),
/*('T2_E1_FR',''),
('T2_E2_FR',''),
('T2_E3_FR',''),
('T2_E4_FR',''),*/
('T1_E1_IT','Ciao e Arrivederci!'),
('T1_E2_IT','Mondi Semplici'),
('T1_E3_IT','Aggettivi e Avverbi'),
('T1_E4_IT','Esame'),
/*('T2_E1_IT',''),
('T2_E2_IT',''),
('T2_E3_IT',''),
('T2_E4_IT',''),*/
('T1_E1_DE','Hallo und auf Wiedersehen!'),
('T1_E2_DE','Einfache Worte'),
('T1_E3_DE','Adjektive und Adverbien'),
('T1_E4_DE','Prüfung'),
/*('T2_E1_DE',''),
('T2_E2_DE',''),
('T2_E3_DE',''),
('T2_E4_DE',''),*/
('T1_E1_RO','Salut și La revedere!'),
('T1_E2_RO','Cuvinte Simple'),
('T1_E3_RO','Adjective și Adverbe'),
('T1_E4_RO','Examen');
/*('T2_E1_RO',''),
('T2_E2_RO',''),
('T2_E3_RO',''),
('T2_E4_RO','');*/

CREATE TABLE puntuacion (
    ID_log INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(30),
    num_test VARCHAR(10),
    puntuacion INT,
    fecha_hora DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE puntuacion
    ADD FOREIGN KEY (usuario) REFERENCES usuarios(usuario),
    ADD FOREIGN KEY (num_test) REFERENCES tests(num_test);