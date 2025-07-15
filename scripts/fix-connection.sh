#!/bin/bash

echo "🔧 Corrigindo problemas de conexão do phpMyAdmin..."

# Parar containers
echo "⏹️  Parando containers..."
docker-compose down

# Remover volumes para reset completo (CUIDADO: isso apaga os dados!)
echo "🗑️  Removendo volumes antigos..."
docker-compose down -v
docker volume prune -f

# Reconstruir e iniciar
echo "🔨 Reconstruindo containers..."
docker-compose up -d --build

# Aguardar MySQL ficar pronto
echo "⏳ Aguardando MySQL inicializar..."
sleep 30

# Verificar se MySQL está rodando
echo "🔍 Verificando status do MySQL..."
docker-compose exec mysql mysqladmin ping -h localhost -u root -prootpassword

# Verificar usuários no MySQL
echo "👥 Verificando usuários criados..."
docker-compose exec mysql mysql -u root -prootpassword -e "SELECT User, Host FROM mysql.user;"

# Testar conexão com usuário 'evento'
echo "🧪 Testando conexão com usuário 'evento'..."
docker-compose exec mysql mysql -u evento -pevento123 -e "SHOW DATABASES;"

echo ""
echo "✅ Correção concluída!"
echo ""
echo "🌐 Acesse: http://localhost:8080"
echo "🗄️  MySQL rodando na porta: 3307 (host) -> 3306 (container)"
echo "👤 Usuário: evento"
echo "🔑 Senha: evento123"
echo ""
echo "🔧 Ou use as credenciais root:"
echo "👤 Usuário: root"
echo "🔑 Senha: rootpassword"
