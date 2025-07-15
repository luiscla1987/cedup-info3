<?php
/**
 * Configuração corrigida do phpMyAdmin para resolver problemas de conexão
 */

declare(strict_types=1);

/**
 * Chave secreta para cookies (32 caracteres)
 */
$cfg['blowfish_secret'] = 'your-secret-key-here-32-chars-long';

/**
 * Configuração dos servidores
 */
$i = 0;

/**
 * Servidor MySQL principal
 */
$i++;
$cfg['Servers'][$i]['auth_type'] = 'cookie';
$cfg['Servers'][$i]['host'] = 'mysql';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;

/**
 * Configurações específicas para resolver problemas de conexão
 */
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['hide_db'] = '^information_schema|performance_schema|mysql|sys$';

/**
 * Configurações gerais
 */
$cfg['DefaultLang'] = 'pt';
$cfg['ServerDefault'] = 1;
$cfg['CheckConfigurationPermissions'] = false;
$cfg['TempDir'] = '/tmp/';

/**
 * Configurações de segurança relaxadas para desenvolvimento
 */
$cfg['AllowArbitraryServer'] = true;
$cfg['LoginCookieValidity'] = 1440;
