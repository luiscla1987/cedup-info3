# Tema: Desenvolvimento Colaborativo de um Sistema Web em PHP #

## Objetivo ##

Desenvolver um sistema web completo, utilizando PHP e banco de dados relacional, onde cada um dos 8 alunos será responsável por uma parte funcional do sistema. O projeto será desenvolvido de forma colaborativa, com versionamento de código utilizando o GitHub, promovendo integração, comunicação e dependência entre os módulos desenvolvidos. O projeto está no link [GitHub](https://github.com/luiscla1987/cedup-info3).

## 1. Definição do Sistema ##

Sugestão: Sistema de Gerenciamento de Eventos

Funcionalidades principais:
- Cadastro de usuários
- Login e autenticação
- Cadastro de eventos
- Inscrição em eventos
- Listagem de eventos
- Controle de presença
- Relatórios
- Administração do sistema

## 2. Divisão de Tarefas entre os Alunos ##

| ID | Módulo/Responsabilidade | Descrição resumida  | Aluno |
| ------------- | ------------- |------------- | ------------- |
| 1	| Modelagem do Banco de Dados |	Criação do modelo relacional, tabelas e integração inicial com PHP | NOME  |
| 2	| Cadastro e Autenticação de Usuários |	Formulários, validação, login, logout e permissões  | NOME  |
| 3	| Cadastro de Eventos |	CRUD de eventos, validação e associação com usuários | NOME  |
| 4	| Inscrição em Eventos | Interface para inscrição, confirmação e cancelamento  | NOME  |
| 5	| Listagem e Busca de Eventos |	Exibição de eventos, filtros e pesquisa  |  NOME  |
| 6	| Controle de Presença | Registro de presença, exportação de listas  |  NOME  |
| 7	| Relatórios e Estatísticas | Geração de relatórios em PDF/Excel, gráficos simples |  NOME  |
| 8	| Administração do Sistema | Gerenciamento de permissões, configurações e auditoria  |  NOME  |

## 3. Integração e Dependência ##

- Cada módulo depende dos dados e funcionalidades dos outros (ex: inscrição depende do cadastro de eventos e usuários).
- O banco de dados deve ser projetado em conjunto, com revisões entre os alunos.
- As interfaces devem seguir um padrão visual e de navegação.
- A integração será feita via branches e pull requests no GitHub, promovendo revisões de código e colaboração.

## 4. Metodologia ##
- Planejamento inicial: reunião para definir o escopo, responsabilidades e cronograma.
- Documentação: cada aluno deve documentar seu código e criar um manual de uso do seu módulo.
- Versionamento: uso do GitHub para controle de versões, issues e integração contínua.
- Reuniões semanais: para acompanhamento do progresso e resolução de dúvidas.
- Apresentação final: demonstração do sistema funcionando, destacando a integração dos módulos.

## 5. Avaliação ##
- Qualidade do código e documentação
- Funcionamento integrado do sistema
- Participação e colaboração no GitHub
- Apresentação e defesa do projeto
