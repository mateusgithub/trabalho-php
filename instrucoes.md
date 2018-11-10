
## Anotações
- SGBD Utilizado: MySQL
- Host utilizado: localhost
- Usuário utilizado para conexão: root
- Senha utilizada para conexão: root
- Database: banco_trabalho_php_si401
- Criação das tabelas: não é necessário rodar script pois o database, tabelas e usuário admin serão criadas automaticamente ao realizar o primeiro login através da tela inicial do sistema /public_html/view/index.php

## Observações
- Caso seja necessário é possível alterar o usuário,senha ou database para conexão. Essas configurações se encontram no arquivo /public_html/dao/Database.php

## Tabelas

### usuario
| Coluna     | Tipo         | Chave |
| ----------:|:------------:|:-----:|
| usuario    | varchar(50)  |   X   |
| nome       | varchar(100) |       |
| cpf        | varchar(11)  |       |
| senha      | varchar(50)  |       |
| cargo      | varchar(50)  |       |


### paciente
| Coluna           | Tipo         | Chave |
| ----------------:|:------------:|:-----:|
| cpf              | varchar(11)  |   X   |
| nome_completo    | varchar(100) |       |
| data_aniversario | varchar(50)  |       |
| telefone         | varchar(50)  |       |
| email            | varchar(50)  |       |
| tipo_sanguineo   | varchar(30)  |       |
| alergias         | varchar(255) |       |
| plano_saude      | varchar(50)  |       |
| prontuario       | varchar(255) |       |
