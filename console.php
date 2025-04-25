#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use SwebApi\AuthService;
use SwebApi\DomainService;

/**
 * Валидация логина.
 */
function isValidLogin(string $login): bool {
    return preg_match('/^[a-zA-Z0-9]+$/', $login);
}

/**
 * Валидация домена: латиница, цифры, дефисы, .ru.
 */
function isValidDomain(string $domain): bool {
    return preg_match('/^[a-z0-9\-]{1,63}\.ru$/i', $domain);
}


echo "Введите логин: ";
$login = trim(fgets(STDIN));

if (!isValidLogin($login)) {
    echo "Неверный формат логина, уберите символы\n";
    exit(1);
}

echo "Введите пароль: ";
$password = trim(fgets(STDIN));


if (strlen($password) < 6) {
    echo "Пароль слишком короткий (минимум 6 символов)\n";
    exit(1);
}

echo "Введите домен (например: example123.ru): ";
$domain = trim(fgets(STDIN));

if (!isValidDomain($domain)) {
    echo "Неверный формат домена. Допустим только .ru\n";
    exit(1);
}

try {
    $auth = new AuthService($login, $password);
    $token = $auth->getToken();
    echo "Токен получен\n";

    $domainService = new DomainService($token);
    $domainService->addDomain($domain);

    echo "Домен {$domain} успешно добавлен\n";
} catch (Exception $e) {
    echo "Ошибка: {$e->getMessage()}\n";
}