<?php
use PHPUnit\Framework\TestCase;
use SwebApi\AuthService;
use SwebApi\ApiClient;

class AuthServiceTest extends TestCase
{
    /**
     * Проверяет успешное получение токена.
     */
    public function testGetToken()
    {
        $mockClient = $this->createMock(ApiClient::class);
        $mockClient->method('call')
            ->with('getToken', [
                'login' => 'testlogin',
                'password' => '123456',
            ])
            ->willReturn(['result' => 'fake-token']);
    
        $authService = new AuthService('testlogin', '123456', $mockClient);
        $token = $authService->getToken();
    
        $this->assertEquals('fake-token', $token);
    }

    /**
     * Проверяет, что выбрасывается исключение, если токен не возвращён.
     */
    public function testGetNoToken()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Token not found');

        $mockClient = $this->createMock(ApiClient::class);
        $mockClient->method('call')
            ->willReturn([]); // нет токена

        $authService = new AuthService('user', 'pass', $mockClient);
        $authService->getToken();
    }
}