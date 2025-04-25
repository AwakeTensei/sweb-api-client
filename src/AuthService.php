<?php
namespace SwebApi;

/**
 * Сервис аутентификации пользователя с получением токена через API sweb.ru.
 */
class AuthService
{
    /**
     * @param string $login Логин пользователя.
     * @param string $password Пароль пользователя.
     * @param ApiClient|null $client Экземпляр клиента API.
     */
    public function __construct(
        private string $login,
        private string $password,
        private ?ApiClient $client = null
    ) {
        $this->client ??= new ApiClient();
    }

    /**
     * Получение токена авторизации от API.
     *
     * @return string Токен авторизации.
     * @throws \RuntimeException Если токен не найден.
     * @throws \Exception При ошибке вызова API.
     */
    public function getToken(): string
    {
        $response = $this->client->call('getToken', [
            'login'  => $this->login,
            'password' => $this->password
        ]);
        print_r($response);
        return $response['result'] ?? throw new \RuntimeException('Token not found');
    }
}