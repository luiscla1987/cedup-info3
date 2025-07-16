-- Script de inicialização do banco de dados
-- Este arquivo será executado automaticamente quando o container MySQL for criado

CREATE DATABASE IF NOT EXISTS evento_db;
USE evento_db;

-- Tabela eventos
CREATE TABLE eventos (
    id_eventos INT AUTO_INCREMENT PRIMARY KEY,
    nome_eventos VARCHAR(255) NOT NULL,
    data_eventos DATE NOT NULL,
    hora_eventos TIME NOT NULL,
    capacidade INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    local_eventos VARCHAR(255) NOT NULL
);

-- Tabela usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nivel_usuarios INT NOT NULL,
    nome_usuarios VARCHAR(255) NOT NULL,
    email_usuarios VARCHAR(255) NOT NULL UNIQUE,
    senha_usuarios VARCHAR(255) NOT NULL,
    cpf_usuarios CHAR(11) NOT NULL UNIQUE
);

-- Tabela inscritos
CREATE TABLE inscritos (
    id_inscritos INT AUTO_INCREMENT PRIMARY KEY,
    nome_inscritos VARCHAR(255) NOT NULL,
    telefone_inscritos VARCHAR(20),
    cpf_inscritos CHAR(11) NOT NULL UNIQUE,
    email_inscritos VARCHAR(255) NOT NULL,
    status INT DEFAULT 1
);

-- Tabela inscritos_eventos
CREATE TABLE inscritos_eventos (
    id_inscricao INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    id_inscrito INT NOT NULL,
    status INT DEFAULT 1,
    FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) ON DELETE CASCADE,
    FOREIGN KEY (id_inscrito) REFERENCES inscritos(id_inscrito) ON DELETE CASCADE
);


-- Criar usuário específico para a aplicação
CREATE USER IF NOT EXISTS 'app_user'@'%' IDENTIFIED BY 'app_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON exemplo_app.* TO 'app_user'@'%';
FLUSH PRIVILEGES;
