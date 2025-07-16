#!/bin/bash

# Script para encontrar uma porta livre

find_free_port() {
    local start_port=$1
    local port=$start_port
    
    while lsof -i :$port > /dev/null 2>&1; do
        ((port++))
        if [ $port -gt $((start_port + 100)) ]; then
            echo "Não foi possível encontrar uma porta livre após $start_port"
            return 1
        fi
    done
    
    echo $port
}

echo "🔍 Procurando portas livres..."

# Encontrar porta livre para MySQL (começando em 3307)
MYSQL_FREE_PORT=$(find_free_port 3307)
echo "🗄️  Porta livre para MySQL: $MYSQL_FREE_PORT"

# Encontrar porta livre para phpMyAdmin (começando em 8080)
PHPMYADMIN_FREE_PORT=$(find_free_port 8080)
echo "🌐 Porta livre para phpMyAdmin: $PHPMYADMIN_FREE_PORT"

echo ""
echo "💡 Para usar essas portas, execute:"
echo "   ./scripts/setup-custom-port.sh $MYSQL_FREE_PORT $PHPMYADMIN_FREE_PORT"
