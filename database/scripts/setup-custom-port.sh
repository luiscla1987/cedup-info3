#!/bin/bash

# Script para configurar MySQL em porta personalizada

MYSQL_PORT=${1:-3307}
PHPMYADMIN_PORT=${2:-8080}

echo "🔧 Configurando MySQL na porta: $MYSQL_PORT"
echo "🌐 Configurando phpMyAdmin na porta: $PHPMYADMIN_PORT"

# Verificar se as portas estão livres
if lsof -i :$MYSQL_PORT > /dev/null 2>&1; then
    echo "❌ Porta $MYSQL_PORT já está em uso!"
    echo "🔍 Processo usando a porta:"
    lsof -i :$MYSQL_PORT
    exit 1
fi

if lsof -i :$PHPMYADMIN_PORT > /dev/null 2>&1; then
    echo "❌ Porta $PHPMYADMIN_PORT já está em uso!"
    echo "🔍 Processo usando a porta:"
    lsof -i :$PHPMYADMIN_PORT
    exit 1
fi

# Parar containers se estiverem rodando
echo "⏹️  Parando containers existentes..."
docker-compose down

# Criar backup do docker-compose.yml
cp docker-compose.yml docker-compose.yml.backup

# Atualizar docker-compose.yml com as novas portas
sed -i.bak "s/\"3306:3306\"/\"$MYSQL_PORT:3306\"/g" docker-compose.yml
sed -i.bak "s/\"8080:80\"/\"$PHPMYADMIN_PORT:80\"/g" docker-compose.yml

echo "✅ Arquivo docker-compose.yml atualizado"

# Iniciar containers
echo "🚀 Iniciando containers com novas portas..."
docker-compose up -d

# Aguardar inicialização
echo "⏳ Aguardando inicialização..."
sleep 30

# Verificar status
echo "📊 Status dos containers:"
docker-compose ps

echo ""
echo "✅ Configuração concluída!"
echo ""
echo "🌐 phpMyAdmin: http://localhost:$PHPMYADMIN_PORT"
echo "🗄️  MySQL: localhost:$MYSQL_PORT"
echo ""
echo "📋 Credenciais:"
echo "   Usuário: evento"
echo "   Senha: evento123"
echo "   OU"
echo "   Usuário: root"
echo "   Senha: rootpassword"
