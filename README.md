## Новостной сайт

Новостной сайт с парсером, форумом и личным кабинетом.

## Запуск приложения

Запустите следующие команды из корневой директории проекта.

```
docker-compose up -d; docker exec laranews_app bash -c "composer install && cp .env.example .env && php artisan load:all"
```


