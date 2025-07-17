CREATE DATABASE IF NOT EXISTS evento_db;
USE evento_db;

-- Tabela eventos
CREATE TABLE IF NOT EXISTS eventos (
    id_eventos INT AUTO_INCREMENT PRIMARY KEY,
    nome_eventos VARCHAR(255) NOT NULL,
    data_eventos DATE NOT NULL,
    hora_eventos TIME NOT NULL,
    capacidade INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    local_eventos VARCHAR(255) NOT NULL
);
-- Get-Content 01-create-database.sql | docker exec -i mysql_db mysql -u root -prootpassword
-- Tabela usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nivel_usuarios INT NOT NULL,
    nome_usuarios VARCHAR(255) NOT NULL,
    email_usuarios VARCHAR(255) NOT NULL UNIQUE,
    senha_usuarios VARCHAR(255) NOT NULL,
    cpf_usuarios CHAR(11) NOT NULL UNIQUE
);


-- Inserção segura do usuário root (sem erro se já existir)
INSERT INTO usuarios (id_usuario, nivel_usuarios, nome_usuarios, email_usuarios, senha_usuarios, cpf_usuarios)
VALUES (1, 2, 'root', 'root@gmail.com', '1234', '12345678901')
ON DUPLICATE KEY UPDATE
    nivel_usuarios = VALUES(nivel_usuarios),
    nome_usuarios = VALUES(nome_usuarios),
    email_usuarios = VALUES(email_usuarios),
    senha_usuarios = VALUES(senha_usuarios),
    cpf_usuarios = VALUES(cpf_usuarios);



-- Tabela inscritos
CREATE TABLE IF NOT EXISTS inscritos (
    id_inscritos INT AUTO_INCREMENT PRIMARY KEY,
    nome_inscritos VARCHAR(255) NOT NULL,
    telefone_inscritos VARCHAR(20),
    cpf_inscritos CHAR(11) NOT NULL UNIQUE,
    email_inscritos VARCHAR(255) NOT NULL,
    status INT DEFAULT 1
);

-- Tabela inscritos_eventos
CREATE TABLE IF NOT EXISTS inscritos_eventos (
    id_inscricao INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    id_inscritos INT NOT NULL,
    status INT DEFAULT 1,
    FOREIGN KEY (id_evento) REFERENCES eventos(id_eventos) ON DELETE CASCADE,
    FOREIGN KEY (id_inscritos) REFERENCES inscritos(id_inscritos) ON DELETE CASCADE
);

-- Tabela listas
CREATE TABLE IF NOT EXISTS listas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela participantes
CREATE TABLE IF NOT EXISTS participantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

-- Tabela presenças
CREATE TABLE IF NOT EXISTS presencas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    participante_id INT NOT NULL,
    lista_id INT NOT NULL,
    data_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    hora_entrada TIME DEFAULT NULL,
    hora_saida TIME DEFAULT NULL,
    status ENUM('presente', 'ausente', 'justificado') DEFAULT 'presente',
    observacoes TEXT DEFAULT NULL,
    FOREIGN KEY (participante_id) REFERENCES participantes(id),
    FOREIGN KEY (lista_id) REFERENCES listas(id)
);


CREATE USER IF NOT EXISTS 'app_user'@'%' IDENTIFIED BY 'app_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON evento_db.* TO 'app_user'@'%';
FLUSH PRIVILEGES;
