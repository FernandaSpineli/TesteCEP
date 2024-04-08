

### Passo a passo
Clone Repositório
```sh
git clone -b laravel-10-com-php-8.1 https://github.com/FernandaSpineli/TesteCEP.git
```
```sh
cd app-laravel
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Especializa Ti"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec nome-do-app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


URL para acessar a listagem de endereços
[http://localhost:8989/addresses](http://localhost:8989/addresses)

URL para buscar um endereço por CEP
[http://localhost:8989/addresses/11111111](http://localhost:8989/addresses/11111111)
