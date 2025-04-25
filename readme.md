# Sweb API PHP Client

Клиентская PHP-библиотека для взаимодействия с JSON-RPC API хостинга [sweb.ru](https://sweb.ru). Поддерживает авторизацию и управление доменами через API.

## 1. Требования к окружению:

- PHP 8.3
- Composer

## 2. Структура проекта:

/sweb-api/
  ├── src/
  │   ├── ApiClient.php
  │   ├── AuthService.php
  │   ├── DomainService.php
  │   └── Logger.php
  ├── tests/
  │   ├── AuthServiceTest.php
  │   └── DomainServiceTest.php
  ├── composer.json
  ├── phpunit.xml
  └── logs/

## Установка

1. Клонирование репозитория:

   ```bash
   git clone https://github.com/yourname/sweb-api-client.git
   cd sweb-api

2. Установка зависимостей:

   ```bash
   composer install

4. Автозагрузка классов:

   ```bash
   composer dump-autoload

5. Запуск тестов:

   ```bash
   vendor/bin/phpunit

7. Проверка функциональности через консольный интерфейс:

   ```bash
   php console.php
