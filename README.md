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
| 1	| Modelagem do Banco de Dados |	Criação do modelo relacional, tabelas e integração inicial com PHP | **RICARDO**  |
| 2	| Cadastro e Autenticação de Usuários |	Formulários, validação, login, logout e permissões  | **THOMAZ**  |
| 3	| Cadastro de Eventos |	CRUD de eventos, validação e associação com usuários | **EDUARDO**  |
| 4	| Inscrição em Eventos | Interface para inscrição, confirmação e cancelamento  | **CASSIANO**  |
| 5	| Listagem e Busca de Eventos |	Exibição de eventos, filtros e pesquisa  |  **JOÃO**  |
| 6	| Controle de Presença | Registro de presença, exportação de listas  |  **LEANDRO**  |
| 7	| Relatórios e Estatísticas | Geração de relatórios em PDF/Excel, gráficos simples |  **DANIEL**  |
| 8	| Administração do Sistema | Gerenciamento de permissões, configurações e auditoria  |  **ANDRÉ**  |

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



# 6. DICAS #

Dicas para Colaboração no Projeto

Para garantir um desenvolvimento colaborativo eficiente e organizado no projeto, siga as dicas abaixo ao contribuir com o repositório:

## 1. Criação de Branches Individuais ##
- Cada aluno deve criar uma branch própria para desenvolver seu módulo ou funcionalidade.
- Nomeie a branch de forma clara, por exemplo: _modulo-cadastro-usuario_, _evento-listagem-nomealuno_.
- Para criar uma branch, utilize o comando:

```bash
git checkout -b nome-da-sua-branch
```

## 2. Sincronização com a Branch Principal ##

- Antes de iniciar o trabalho, sempre atualize sua branch com as últimas alterações da branch principal (main ou master):

```bash
git checkout main
git pull
git checkout nome-da-sua-branch
git merge main
```
- Resolva conflitos localmente antes de enviar suas alterações.

## 3. Commits Frequentes e Descritivos ## 
- Faça commits frequentes para registrar o progresso.
- Escreva mensagens de commit claras e objetivas, indicando o que foi alterado ou adicionado.

## 4. Pull Requests e Revisão de Código ## 
- Ao finalizar uma tarefa ou módulo, crie um Pull Request (PR) para a branch principal.
- Adicione outro aluno como reviewer do seu PR para revisar e aprovar o código antes do merge.
- Solicite revisão de pelo menos um colega antes de realizar o merge.
- Utilize os comentários do PR para discutir melhorias, dúvidas ou sugestões.

## 5. Organização e Comunicação ##
- Utilize as Issues do GitHub para reportar bugs, sugerir melhorias ou dividir tarefas.
- Participe das reuniões semanais e mantenha a comunicação ativa com o grupo.
- Documente seu código e atualize o README ou o manual do seu módulo conforme necessário.

## 6. Padrão de Código e Interface ##
- Siga o padrão visual e de navegação definido pelo grupo para manter a consistência do sistema.
- Integre seu módulo considerando as dependências com os demais módulos (ex: cadastro de eventos depende de usuários).


Essas práticas ajudam a evitar conflitos de código, facilitam a integração dos módulos e promovem um ambiente colaborativo mais produtivo.

