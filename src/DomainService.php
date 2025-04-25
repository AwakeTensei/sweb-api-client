<?php
namespace SwebApi;

/**
 * Сервис добавления доменов через API sweb.ru.
 */
class DomainService
{
    /**
     * @param string $token Токен авторизации.
     * @param ApiClient|null $client Необязательный кастомный клиент для подмены в запросах (например, в тестах).
     */
    public function __construct(
        private string $token,
        private ?ApiClient $client = null
    ) {
        $this->client ??= new ApiClient($this->token);
    }

    /**
     * Добавляет домен для учетной записи.
     *
     * @param string $domain Имя домена (например, example.ru).
     * @throws \Exception Если домен уже добавлен или при другой ошибке API.
     */
    public function addDomain(string $domain): void
    {
        try {
            $this->client->call('move', [
                'domain' => $domain,
                'prolongType' => 'manual',
            ]);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'already exists')) {
                throw new \Exception('Domain already added');
            }
            throw $e;
        }
    }
}