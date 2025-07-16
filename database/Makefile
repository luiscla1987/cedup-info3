# Makefile para facilitar o gerenciamento dos containers

.PHONY: up down restart logs clean build fix-connection troubleshoot create-user reset logs-error check-ports find-ports setup-ports

# Subir os serviços
up:
	docker-compose up -d

# Parar os serviços
down:
	docker-compose down

# Reiniciar os serviços
restart:
	docker-compose restart

# Ver logs
logs:
	docker-compose logs -f

# Ver logs do MySQL
logs-mysql:
	docker-compose logs -f mysql

# Ver logs do phpMyAdmin
logs-phpmyadmin:
	docker-compose logs -f phpmyadmin

# Limpar containers e volumes
clean:
	docker-compose down -v
	docker system prune -f

# Construir as imagens
build:
	docker-compose build

# Entrar no container MySQL
mysql-shell:
	docker-compose exec mysql mysql -u root -p

# Backup do banco de dados
backup:
	docker-compose exec mysql mysqldump -u root -p --all-databases > backup_$(shell date +%Y%m%d_%H%M%S).sql

# Status dos containers
status:
	docker-compose ps

# Comandos para resolver problemas de conexão
fix-connection:
	./scripts/fix-connection.sh

troubleshoot:
	./scripts/troubleshoot.sh

create-user:
	./scripts/create-user.sh evento evento123 evento_db

# Reset completo (CUIDADO: apaga todos os dados)
reset:
	docker-compose down -v
	docker system prune -f
	docker-compose up -d --build

# Verificar logs de erro
logs-error:
	docker-compose logs mysql | grep -i error
	docker-compose logs phpmyadmin | grep -i error

# Verificar portas
check-ports:
	./scripts/check-ports.sh

# Encontrar portas livres
find-ports:
	./scripts/find-free-port.sh

# Configurar portas personalizadas
setup-ports:
	./scripts/setup-custom-port.sh 3307 8080
