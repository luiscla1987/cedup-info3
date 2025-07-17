
CREATE TABLE IF NOT EXISTS inscricoes (
    id_inscricao INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    nome_participante VARCHAR(255) NOT NULL,
    status_inscricao ENUM('confirmada', 'cancelada') NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id_eventos)
);



-- Dados de exemplo para a tabela eventos
INSERT INTO eventos (nome_eventos, data_eventos) VALUES
('Workshop de PHP Avançado', '2024-02-15'),
('Seminário de Tecnologia e Inovação', '2024-02-20'),
('Curso de JavaScript Moderno', '2024-02-25'),
('Palestra sobre Inteligência Artificial', '2024-03-01'),
('Treinamento em Banco de Dados', '2024-03-05');

-- Dados de exemplo para a tabela inscricoes
INSERT INTO inscricoes (id_evento, nome_participante, status_inscricao) VALUES
(1, 'João Silva', 'confirmada'),
(1, 'Maria Santos', 'confirmada'),
(2, 'Pedro Oliveira', 'confirmada'),
(2, 'Ana Costa', 'cancelada'),
(3, 'Carlos Ferreira', 'confirmada');

