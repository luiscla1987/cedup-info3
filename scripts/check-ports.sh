#!/bin/bash

echo "🔍 Verificando portas em uso..."
echo "================================"

# Verificar porta 3306
echo "📊 Porta 3306 (MySQL padrão):"
if lsof -i :3306 > /dev/null 2>&1; then
    echo "❌ OCUPADA"
    lsof -i :3306
else
    echo "✅ LIVRE"
fi

echo ""

# Verificar porta 3307
echo "📊 Porta 3307 (MySQL alternativa):"
if lsof -i :3307 > /dev/null 2>&1; then
    echo "❌ OCUPADA"
    lsof -i :3307
else
    echo "✅ LIVRE"
fi

echo ""

# Verificar porta 8080
echo "📊 Porta 8080 (phpMyAdmin):"
if lsof -i :8080 > /dev/null 2>&1; then
    echo "❌ OCUPADA"
    lsof -i :8080
else
    echo "✅ LIVRE"
fi

echo ""

# Sugerir portas alternativas
echo "🔧 Portas alternativas sugeridas:"
echo "   MySQL: 3307, 3308, 3309, 33060"
echo "   phpMyAdmin: 8080, 8081, 8082, 9090"

echo ""

# Verificar processos MySQL rodando
echo "🗄️  Processos MySQL em execução:"
ps aux | grep mysql | grep -v grep || echo "Nenhum processo MySQL encontrado"

echo ""

# Verificar serviços na porta 3306
echo "🔍 Detalhes da porta 3306:"
netstat -tulpn | grep :3306 || echo "Porta 3306 não está em uso"
