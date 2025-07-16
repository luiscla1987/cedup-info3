#!/bin/bash

# Script para criar usuário manualmente se necessário

USER_NAME=${1:-evento}
USER_PASSWORD=${2:-evento123}
DATABASE_NAME=${3:-evento_db}

echo "👤 Criando usuário: $USER_NAME"
echo "🗄️  Para banco: $DATABASE_NAME"

# Conectar ao MySQL e criar usuário
docker-compose exec mysql mysql -u root -prootpassword << EOF
-- Remover usuário se existir
DROP USER IF EXISTS '$USER_NAME'@'%';
DROP USER IF EXISTS '$USER_NAME'@'localhost';

-- Criar usuário
CREATE USER '$USER_NAME'@'%' IDENTIFIED BY '$USER_PASSWORD';
CREATE USER '$USER_NAME'@'localhost' IDENTIFIED BY '$USER_PASSWORD';

-- Criar banco se não existir
CREATE DATABASE IF NOT EXISTS $DATABASE_NAME;

-- Conceder permissões
GRANT ALL PRIVILEGES ON $DATABASE_NAME.* TO '$USER_NAME'@'%';
GRANT ALL PRIVILEGES ON $DATABASE_NAME.* TO '$USER_NAME'@'localhost';

-- Permissões globais (opcional, para desenvolvimento)
GRANT ALL PRIVILEGES ON *.* TO '$USER_NAME'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO '$USER_NAME'@'localhost' WITH GRANT OPTION;

-- Aplicar mudanças
FLUSH PRIVILEGES;

-- Verificar criação
SELECT User, Host FROM mysql.user WHERE User = '$USER_NAME';
EOF

echo "✅ Usuário criado com sucesso!"
echo "🧪 Testando conexão..."

docker-compose exec mysql mysql -u $USER_NAME -p$USER_PASSWORD -e "SHOW DATABASES;"
