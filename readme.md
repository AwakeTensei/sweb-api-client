# Sweb API PHP Client

Клиент для взаимодействия с API хостинга [sweb.ru](https://sweb.ru) в формате JRPC. Поддерживает авторизацию и управление доменами по API.

Требования к окружению

PHP 8.3
Composer

Структура проекта

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

Установка

Клонируйте репозиторий:

git clone https://github.com/yourname/sweb-api-client.git
cd sweb-api



Установите зависимости:

composer install



Сгенерируйте автозагрузку классов:

composer dump-autoload



Запустите тесты:

vendor/bin/phpunit



Проверьте функциональность через консольный интерфейс:

php console.php
