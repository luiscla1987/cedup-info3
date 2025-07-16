#!/bin/bash

# Script de configuração inicial

echo "🚀 Configurando ambiente phpMyAdmin + MySQL..."

# Criar diretórios necessários
mkdir -p mysql/init
mkdir -p config
mkdir -p backups

# Definir permissões
chmod +x scripts/setup.sh

# Verificar se Docker está instalado
if ! command -v docker &> /dev/null; then
    echo "❌ Docker não está instalado. Por favor, instale o Docker primeiro."
    exit 1
fi

# Verificar se Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose não está instalado. Por favor, instale o Docker Compose primeiro."
    exit 1
fi

# Criar arquivo .env se não existir
if [ ! -f .env ]; then
    echo "📝 Criando arquivo .env..."
    cp .env.example .env 2>/dev/null || echo "Arquivo .env criado com configurações padrão"
fi

# Subir os serviços
echo "🐳 Iniciando containers..."
docker-compose up -d

# Aguardar os serviços ficarem prontos
echo "⏳ Aguardando serviços ficarem prontos..."
sleep 10

# Verificar status
echo "📊 Status dos containers:"
docker-compose ps

echo ""
echo "✅ Configuração concluída!"
echo ""
echo "🌐 Acesse o phpMyAdmin em: http://localhost:8080"
echo "🗄️  MySQL está rodando na porta: 3306"
echo ""
echo "📋 Credenciais padrão:"
echo "   Usuário: root"
echo "   Senha: rootpassword"
echo ""
echo "🛠️  Comandos úteis:"
echo "   make up      - Iniciar serviços"
echo "   make down    - Parar serviços"
echo "   make logs    - Ver logs"
echo "   make clean   - Limpar tudo"
