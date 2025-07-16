-- Script de inicialização do banco de dados
-- Este arquivo será executado automaticamente quando o container MySQL for criado

-- Criar banco de dados de exemplo
CREATE DATABASE IF NOT EXISTS exemplo_app;

-- Usar o banco de dados
USE exemplo_app;

-- Criar tabela de usuários de exemplo
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Inserir dados de exemplo
INSERT INTO usuarios (nome, email, senha) VALUES
('João Silva', 'joao@exemplo.com', MD5('123456')),
('Maria Santos', 'maria@exemplo.com', MD5('123456')),
('Pedro Oliveira', 'pedro@exemplo.com', MD5('123456'));

-- Criar tabela de produtos de exemplo
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT DEFAULT 0,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir produtos de exemplo
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Notebook Dell', 'Notebook Dell Inspiron 15', 2500.00, 10),
('Mouse Logitech', 'Mouse sem fio Logitech MX Master', 350.00, 25),
('Teclado Mecânico', 'Teclado mecânico RGB', 450.00, 15);

-- Criar usuário específico para a aplicação
CREATE USER IF NOT EXISTS 'app_user'@'%' IDENTIFIED BY 'app_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON exemplo_app.* TO 'app_user'@'%';
FLUSH PRIVILEGES;
