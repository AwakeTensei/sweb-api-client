<?php
namespace SwebApi;

/**
 * Клиент для работы с API Sweb.ru (JRPC).
 */
class ApiClient
{
    private string $apiUrl;
    
   /**
    * @param string|null $token Токен авторизации (если есть)
    */
    public function __construct(private ?string $token = null)
    {
        // Для авторизованных пользователей
        $this->apiUrl = $this->token ? 'https://api.sweb.ru/domains' : 'https://api.sweb.ru/notAuthorized/';
    }

    /**
     * Выполняет JRPC запрос к API Sweb.ru.
     *
     * @param string $method Используемый метод API
     * @param array $params Параметры запроса
     * @return array Результат вызова
     * @throws \Exception При ошибке CURL или ответе от API с ошибкой
     */
    public function call(string $method, array $params): array
    {
        $payload = [
            'jsonrpc' => '2.0',
            'method'  => $method,
            'params'  => $params,
            'id'      => rand(1, 99999),
        ];

        $json = json_encode($payload);
        Logger::log("Request: $json");

        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $json,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                $this->token ? "Authorization: Bearer $this->token" : '',
            ],
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        Logger::log("Response: $response");

        if ($error) {
            throw new \Exception("CURL Error: $error");
        }

        $data = json_decode($response, true);
        if (isset($data['error'])) {
            throw new \Exception($data['error']['message']);
        }

        return $data ?? [];
    }
}