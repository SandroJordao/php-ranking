# Coding challenge
### Descrição:
Construir um endpoint REST que retorne o ranking de um determinado movimento, trazendo o nome do movimento e uma lista ordenada com os usuários, seu respectivo recorde pessoal (maior valor), posição e data.

### Desenvolvido em Lumen

Lumen é um micro-framework baseado em Laravel, voltado para o desenvolvimento de aplicações de microsserviços e APIs RESTful.


### Requisitos:

Os seguintes componentes devem ser instalados:

[PHP](https://www.php.net/) v7+.

[MYSQL](https://www.mysql.com/).

### Instalação e Configuração:

* Clone o repositório

```
git clone https://github.com/SandroJordao/php-ranking.git
```

* Criar Banco de Dados

``` 
mysql -uroot -p create database ranking
```

* Configuração do arquivo .env

Renomear o arquivo ".env.example" para ".env" na raiz do projeto e configurar com os dados de acesso ao banco, exemplo:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ranking
DB_USERNAME=root
DB_PASSWORD=
```

* Criar as tabelas

``` 
php artisan migrate
```

* Inserir os dados

``` 
php artisan db:seed
```

* Execultar o Projeto

``` 
php -S localhost:8000 -t public
```

## API
Recursos disponíveis para acesso via API:

### List [GET /api/ranking/{movement_id}]
Response 200 (application/json)

```
[
    {
        "movement_name": "string",
        "user_name": "string",
        "value": "float",
        "user_rank": "int",
        "date": "datetime"
    }
]
```

* Curl

``` 
curl --location --request GET 'http://localhost:8000/api/ranking/{movement_id}'
```
