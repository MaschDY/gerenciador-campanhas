# Sistema Gerenciador De Campanhas

Sistema de cadastro de empresas e participantes vinculados as empresas.


# Ferramentas Utilizadas

- Wampserver
- PHP
- MySQL
- Composer
- Symfony
- Twig


# Iniciando

1° - Será necessário realizar a instalação do WampServer.

2° - Baixar os arquivos do repositório: git clone https://github.com/MaschDY/gerenciador-campanhas

- Colocar os arquivos no diretorio: C:\wamp64\www

3° - Acessar o phpMyAdmin: http://localhost/phpmyadmin/index.php

- Criar banco de dados com nome gerenciamento-campanhas

- Importar arquivo gerenciamento-campanhas.sql para o banco de dados.

4° Sistema pronto para uso.

# Endpoints
Participantes:
- Listar Participantes
GET http://localhost/?page=participante&cpf={{participante.cpf}}

- Cadastrar Participantes
POST http://localhost/?page=participante&method=insert

- Alterar Participantes
POST http://localhost/?page=participante&method=update

- Remover Participantes
DELETE http://localhost/?page=participante&method=delete&cpf={{cpf}}

Empresas:
- Listar Empresas
GET http://localhost/?page=empresa&cnpj={{empresa.cnpj}}

- Cadastrar Empresas
POST http://localhost/?page=empresa&method=insert

- Alterar Empresas
POST http://localhost/?page=empresa&method=update

- Remover Empresas
DELETE http://localhost/?page=empresa&method=delete&cnpj={{cnpj}}
