## Новостной сайт

Новостной сайт с парсером, форумом и личным кабинетом.

## Запуск приложения

Запустите следующие команды из корневой директории проекта.

```
docker-compose up -d
composer install
```
Далее необходимо переименовать .env.example в .env, создать соединение с БД по порту 8101 и выполнить следующие команды:

```
docker exec -it laranews_app bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan schedule:work
```


