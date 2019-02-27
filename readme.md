# Teste Connect Parts
Projeto de teste de desenvolvimento para a Connect Parts.

## Pré-requisitos
Antes de iniciar, certifique-se de que seu servidor possuí: 
- PHP 7+
- MYSQL 5+

## Passo 1: Instalando o projeto
Clone o projeto do bitbucket para sua máquina.

`<base_dir>$ git clone https://github.com/ro-damasceno/test.git`

Agora precisamos baixar as dependências do projeto e para isto vamos usar o composer. 
Caso ainda não possua o composer em sua máquina, instale-o seguindo as [instruções](https://getcomposer.org/doc/00-intro.md). 

No diretório raiz do projeto, execute o comando:

`<base_dir>/test$ composer install`

Depois de instalado o projeto, você pode executa o comando para iniciar o servidor:

`php artisan serve`

## Passo 2: Criando o banco de dados

Crie o banco de dados da aplicação e configure os dados de acesso no arquivo .env.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=local_db
DB_USERNAME=root
DB_PASSWORD=we23we23
```

Execute o comando para criar as tabelas no banco de dados:

`
php artisa migrate
`
