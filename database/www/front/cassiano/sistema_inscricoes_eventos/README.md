# Sistema de Gerenciamento de Inscrições em Eventos

Este sistema permite gerenciar inscrições em eventos, oferecendo funcionalidades para confirmar e cancelar inscrições de participantes.

## Funcionalidades

- ✅ Seleção de eventos cadastrados
- ✅ Confirmação de inscrições
- ✅ Cancelamento de inscrições
- ✅ Visualização de inscrições atuais
- ✅ Interface responsiva e moderna
- ✅ Validação de dados
- ✅ Mensagens de feedback

## Estrutura do Projeto

```
projeto/
├── index.html              # Página principal
├── style.css              # Estilos CSS
├── script.js              # JavaScript para interatividade
├── db_connect.php         # Conexão com banco de dados
├── processa_inscricao.php # Processamento de inscrições
├── get_eventos.php        # API para buscar eventos
├── get_inscricoes.php     # API para buscar inscrições
├── database.sql           # Script de criação das tabelas
└── README.md              # Este arquivo
```

## Pré-requisitos

- Servidor web com PHP (Apache/Nginx)
- MySQL ou MariaDB
- PHP 7.4 ou superior
- Extensão MySQLi habilitada

## Instalação

### 1. Configuração do Banco de Dados

1. Crie um banco de dados chamado `eventos_db`:
```sql
CREATE DATABASE eventos_db;
USE eventos_db;
```

2. Execute o script `database.sql` para criar as tabelas:
```sql
-- Tabela de eventos (deve já existir)
CREATE TABLE IF NOT EXISTS eventos (
    id_eventos INT AUTO_INCREMENT PRIMARY KEY,
    nome_eventos VARCHAR(255) NOT NULL,
    data_eventos DATE NOT NULL
);

-- Tabela de inscrições
CREATE TABLE IF NOT EXISTS inscricoes (
    id_inscricao INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    nome_participante VARCHAR(255) NOT NULL,
    status_inscricao ENUM('confirmada', 'cancelada') NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id_eventos)
);
```

3. Insira alguns eventos de exemplo:
```sql
INSERT INTO eventos (nome_eventos, data_eventos) VALUES
('Workshop de PHP', '2024-02-15'),
('Seminário de Tecnologia', '2024-02-20'),
('Curso de JavaScript', '2024-02-25');
```

### 2. Configuração do PHP

1. Edite o arquivo `db_connect.php` e ajuste as configurações do banco:
```php
$host = 'localhost';        // Host do banco
$username = 'root';         // Usuário do banco
$password = '';             // Senha do banco
$database = 'eventos_db';   // Nome do banco
```

### 3. Configuração do Servidor Web

1. Coloque todos os arquivos na pasta do seu servidor web (htdocs, www, etc.)
2. Certifique-se de que o PHP está funcionando
3. Acesse `http://localhost/seu-projeto/index.html`

## Como Usar

### 1. Confirmar Inscrição
1. Selecione um evento da lista
2. Digite o nome do participante
3. Clique em "Confirmar Inscrição"

### 2. Cancelar Inscrição
1. Selecione o evento
2. Digite o nome do participante (deve ser exatamente igual ao cadastrado)
3. Clique em "Cancelar Inscrição"

### 3. Visualizar Inscrições
- As inscrições atuais são exibidas automaticamente no painel direito
- Inscrições confirmadas aparecem com borda verde
- Inscrições canceladas aparecem com borda vermelha e opacidade reduzida

## Recursos Técnicos

### Frontend
- **HTML5** com estrutura semântica
- **CSS3** com design responsivo e gradientes
- **JavaScript** para interatividade e requisições AJAX
- **Design responsivo** para dispositivos móveis

### Backend
- **PHP** com MySQLi para segurança
- **Prepared Statements** para prevenir SQL Injection
- **Validação de dados** no servidor
- **Respostas JSON** para comunicação com frontend

### Segurança
- Sanitização de dados de entrada
- Prepared statements para consultas SQL
- Validação de métodos HTTP
- Tratamento de erros

## Personalização

### Cores e Estilos
Edite o arquivo `style.css` para personalizar:
- Cores do tema (gradientes)
- Fontes e tamanhos
- Espaçamentos e layouts

### Funcionalidades
- Adicione novos campos na tabela `inscricoes`
- Implemente filtros de busca
- Adicione paginação para muitas inscrições
- Integre com sistema de e-mail

## Solução de Problemas

### Erro de Conexão com Banco
- Verifique as credenciais em `db_connect.php`
- Certifique-se de que o MySQL está rodando
- Verifique se o banco `eventos_db` existe

### Eventos Não Carregam
- Verifique se a tabela `eventos` tem dados
- Confirme que a estrutura da tabela está correta
- Verifique logs de erro do PHP

### JavaScript Não Funciona
- Abra o console do navegador (F12)
- Verifique se há erros JavaScript
- Confirme que os arquivos PHP estão retornando JSON válido

## Suporte

Para dúvidas ou problemas:
1. Verifique os logs de erro do servidor
2. Teste as URLs PHP diretamente no navegador
3. Use o console do navegador para debug JavaScript

