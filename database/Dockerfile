# Dockerfile personalizado para phpMyAdmin (opcional)
# Geralmente não é necessário, pois a imagem oficial já atende a maioria dos casos

FROM phpmyadmin/phpmyadmin:latest

# Instalar extensões PHP adicionais se necessário
# RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar configurações personalizadas se necessário
# COPY config.inc.php /etc/phpmyadmin/config.inc.php

# Definir variáveis de ambiente padrão
ENV PMA_ARBITRARY=1
ENV PMA_HOST=mysql
ENV PMA_PORT=3306

# Expor porta 80
EXPOSE 80

# O comando padrão já está definido na imagem base
