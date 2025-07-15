-- Script para corrigir permissões do usuário 'evento'

-- Remover usuário existente se houver problemas
DROP USER IF EXISTS 'evento'@'%';
DROP USER IF EXISTS 'evento'@'localhost';

-- Criar usuário 'evento' com senha
CREATE USER 'evento'@'%' IDENTIFIED BY 'evento123';

-- Conceder todas as permissões ao usuário 'evento'
GRANT ALL PRIVILEGES ON *.* TO 'evento'@'%' WITH GRANT OPTION;

-- Criar usuário para localhost também
CREATE USER 'evento'@'localhost' IDENTIFIED BY 'evento123';
GRANT ALL PRIVILEGES ON *.* TO 'evento'@'localhost' WITH GRANT OPTION;

-- Aplicar as mudanças
FLUSH PRIVILEGES;

-- Verificar usuários criados
SELECT User, Host FROM mysql.user WHERE User = 'evento';
