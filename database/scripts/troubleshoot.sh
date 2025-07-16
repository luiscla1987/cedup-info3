#!/bin/bash

echo "🔍 Diagnóstico de problemas do phpMyAdmin + MySQL"
echo "================================================"

# Verificar se containers estão rodando
echo "📊 Status dos containers:"
docker-compose ps

echo ""
echo "🔗 Testando conectividade de rede:"
docker-compose exec phpmyadmin ping -c 3 mysql

echo ""
echo "🗄️  Verificando usuários no MySQL:"
docker-compose exec mysql mysql -u root -prootpassword -e "SELECT User, Host, authentication_string FROM mysql.user WHERE User IN ('root', 'evento');"

echo ""
echo "🔐 Testando autenticação do usuário 'evento':"
docker-compose exec mysql mysql -u evento -pevento123 -e "SELECT 'Conexão OK' as status;"

echo ""
echo "📋 Variáveis de ambiente do phpMyAdmin:"
docker-compose exec phpmyadmin env | grep -E "(PMA_|MYSQL_)"

echo ""
echo "📝 Logs recentes do MySQL:"
docker-compose logs --tail=20 mysql

echo ""
echo "📝 Logs recentes do phpMyAdmin:"
docker-compose logs --tail=20 phpmyadmin

echo ""
echo "🌐 URLs de acesso:"
echo "   phpMyAdmin: http://localhost:8080"
echo "   MySQL: localhost:3307"
