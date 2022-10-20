# Тестовое задание 

Подключение платежных шлюзов

## Репозиторий

https://github.com/Archetarcher/test-backend
## Использует

- [Laravel] v.9.19.
- PHP v.8.1
- [Docker] - CI/CD.
- [Composer] - Пакетный менеджер для php.




## Установка

Из директории проекта:

```
docker-compose  up  --build
```

Необходимо сконфигурировать файл `.env` по примеру `.env.example`



Установка всех пакетов:

```sh
docker-compose  exec laravel.test composer install
```

Генерация ключа приложения:

```sh
docker-compose  exec laravel.test php artisan key:generate
```

Накатить миграции:

```sh
docker-compose  exec laravel.test php artisan migrate
```

## Разработка

### Контроллеры

* Формирование ответа
  ``
  app/Http/Controllers/ApiController.php
  ``

* Запрос по платежам
  ``
  app/Http/Controllers/PaymentController.php
  ``

Форм-запросы:
``
app/Http/Requests
``

Сервис-провайдеры:
``
app/Providers.php
``

### Контракты

* Платежи:
  ``
  app/Contracts/PaymentContract.php
  ``

### Сервисы

* Платежные шлюзы:
  ``
  app/Services/(FirstPayment|SecondPayment)Service.php
  ``

Коды ошибок:
``
app/Enum/StatusCodeEnum.php
``

Модели:
``
app/Models
``

Репозитории:
``
app/repositories
``
``

Миграции:
``
database/migrations
``

## API

### Описание API:

---
Обработчик состояния платежа:

```
/api/callback-url
```

[Docker]: <https://docs.docker.com/>

[Laravel]: <https://laravel.com/docs/8.x>

[Composer]: <https://getcomposer.org/>
