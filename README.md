# Projeto Resume

Projeto de exemplo de um sistema para gerenciamento de currículos de uma empresa, utilizando Laravel no backend e React no frontend.

## Conteúdo

- [Visão Geral](#visão-geral)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Configuração do Ambiente de Desenvolvimento](#configuração-do-ambiente-de-desenvolvimento)
- [Executando o Projeto](#executando-o-projeto)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Visão Geral

Este projeto consiste em uma aplicação web para gerenciar currículos de candidatos para uma empresa. O backend é desenvolvido em Laravel e fornece uma API REST para manipulação dos dados. O frontend é construído em React e permite aos usuários enviar seus currículos, além de visualizar e pesquisar os currículos existentes.

Além disso, o projeto conta com os seguintes recursos:

- Validação de formulários tanto no frontend quanto no backend.
- Envio de e-mails de confirmação para o usuário e administrador.
- Testes unitários para garantir a robustez do código.
- Utilização de libs como Husky e Pint para padronização do código com PSR-12.

## Tecnologias Utilizadas

### Backend (Laravel)

- Laravel
- MySQL (container Docker)
- Husky
- Pint
- Outras dependências do Laravel

### Frontend (React)

- React
- Axios (para requisições HTTP)
- Outras dependências do React

## Configuração do Ambiente de Desenvolvimento

Certifique-se de ter o Docker instalado na sua máquina para configurar o ambiente de desenvolvimento.

### Backend

1. Clone este repositório.
2. Navegue até a pasta `resume` no terminal.
3. Execute `composer install` para instalar as dependências do Laravel.
4. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente necessárias, incluindo as credenciais do banco de dados.
5. Execute `docker-compose up -d` para iniciar o container de email.
6. Execute `php artisan migrate` para criar as tabelas no banco de dados.
7. Execute `php artisan serve` para iniciar o servidor Laravel.
8. Tenha um container ou um banco Mysql no seu computador.

### Frontend

1. Navegue até a pasta `resume-front` no terminal.
2. Execute `npm install` para instalar as dependências do React.
3. Configure as variáveis de ambiente necessárias, como a URL da API no arquivo `.env`.
4. Execute `npm start` para iniciar o servidor de desenvolvimento do React.

## Executando o Projeto

Após configurar o ambiente de desenvolvimento, você pode acessar a aplicação através do navegador. Certifique-se de que tanto o backend quanto o frontend estão em execução.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request com melhorias, correções de bugs, ou novos recursos.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
