<?php
namespace App\Tests\InfraLayer;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Dotenv\Dotenv;
use App\InfraLayer\ProductRepository;
use App\DomainLayer\Interfaces\ProductRepositoryInterface;
use App\DomainLayer\Models\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

class ProductListControllerTest extends WebTestCase
{

    private $existingProducts;

    public function setUp(): void
    {
        $this->existingProducts = [
            new Product('000001', 'Military Boots', 'boots', 37000),
            new Product('000002', 'Construction boots', 'boots', 37000),
            new Product('000003', 'Casual shoes', 'shoes', 34000),
            new Product('000004', 'Sport leggings', 'leggins', 57000),
            new Product('000005', 'Runners shoes', 'shoes', 99000),
        ];
    }

    public function test_list_response()
    {
        $client = static::createClient();

        $container = self::$container;
        $productRepoMock = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findAllWithLimit', 'findAllByCriteria'])
            ->getMock();
        $productRepoMock->method('findAllWithLimit')->willReturn($this->existingProducts);
        $productRepoMock->expects($this->any())->method('findAllByCriteria')->willReturn($this->existingProducts);
        $container->set('App\InfraLayer\ProductRepository', $productRepoMock);

        $crawler = $client->request('GET', '/api/v1/products');
        $response = $client->getResponse();
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/json', $response->headers->all()['content-type'][0]);
    }

}