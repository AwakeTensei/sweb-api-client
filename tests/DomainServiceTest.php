<?php
use PHPUnit\Framework\TestCase;
use SwebApi\DomainService;
use SwebApi\ApiClient;

class DomainServiceTest extends TestCase
{
    /**
     * Проверяет успешное добавление домена.
     */
    public function testAddDomain()
    {
        $mockClient = $this->createMock(ApiClient::class);
        $mockClient->expects($this->once())
            ->method('call')
            ->with('move', [
                'domain' => 'example.ru',
                'prolongType' => 'manual',
            ])
            ->willReturn([]);
    
        $service = new DomainService('fake-token', $mockClient);
    
        $this->assertNull($service->addDomain('example.ru'));
    }

    /**
     * Проверяет, что при повторном добавлении домена выбрасывается исключение.
     */
    public function testAddExistDomain()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Domain already added');

        $mockClient = $this->createMock(ApiClient::class);
        $mockClient->method('call')
            ->willThrowException(new \Exception('Domain already exists'));

        $service = new DomainService('token', $mockClient);
        $service->addDomain('test.ru');
    }
}