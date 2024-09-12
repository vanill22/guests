# Laravel Guest Microservice

## Установка и запуск проекта

```bash
    git clone https://github.com/vanill22/guests.git
    cd guests
```
## Docker

```bash
    docker-compose up --force-recreate
```

## Войти в контейнер

```bash
    docker exec -it guests-php-1 sh
```

## Создайте файл `.env` на основе `.env.example`

```bash
    cp .env.example .env
```

## Установите зависимости через Composer
```bash
    composer install
```

## Сгенерируйте ключ приложения
```bash
    php artisan key:generate
```

## Доступы
```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel
    DB_PASSWORD=password
```

## Примеры запросов в .http файле