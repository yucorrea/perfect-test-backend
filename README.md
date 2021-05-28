<h1 align="center">
    <img src="./github/logo-original.png" width="250px" alt="Perfect Pay" title="Perfect Pay">
</h1>

<h4 align="center">
    Desafio Back-End Perfect Pay
</h4>

<p align="center">
  &nbsp;&nbsp;&nbsp;
  <a href="#dart-desafio">Desafio</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#computer-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#information_source-como-usar">Como usar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>


## :dart: Desafio
   O desafio é desenvolver um sistema de vendas onde consiste um cadastro de produtos, o próprio cadastro de vendas onde será preenchido alguns dados também referente a cliente, uma dashboard onde estará centralizado os dados de produtos, consulta de vendas e um relatório simplificado de vendas.
 
## :computer: Tecnologias 

- [MYSQL](https://www.mysql.com/)
- [Laravel](https://laravel.com/)

## :information_source: Como usar

Você deve ter os seguintes programas instalados em seu sistema operacional. [Git](https://git-scm.com) | [Node.js](https://nodejs.org/en/) | [Composer](https://getcomposer.org/) | [PHP](https://www.php.net/) | [MYSQL](https://www.mysql.com/)


## Iniciando aplicação

```bash
# Clone o repositório 
$ git clone https://github.com/yucorrea/perfect-test-backend.git

# Navegando para a pasta do projeto
$ cd perfect-test-backend

# Instalar dependências
$ composer install

# Edite os campos abaixo no seu arquivo .env para configurar a base de dados.

$ DB_CONNECTION=mysql
$ DB_HOST=127.0.0.1
$ DB_PORT=3306
$ DB_DATABASE=laravel
$ DB_USERNAME=root
$ DB_PASSWORD=

# Limpar cache
$ php artisan config:cache

# Criar migrations
$ php artisan migrate

# Criar URL para visualizar as imagens
$ php artisan storage:link

# Iniciar aplicação
$ php artisan serve

## Laravel development server started: http://127.0.0.1:8000
```

Feito com :heart: by Yuri Corrêa :wave: [Contato](https://www.linkedin.com/in/yucorrea/)
