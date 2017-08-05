<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 05/08/17
 * Time: 17:50
 */

namespace APIBundle\Tests\Manager;

use APIBundle\Manager\DataManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use TMSHomeworkBundle\Entity\Product;
use TMSHomeworkBundle\Entity\Purchase;

class DataManagerTest extends TestCase
{
    public function testListAllPurchases()
    {
        $product = new Product();
        $product->setName('test product');
        $product->setPrice(100);

        $purchase = new Purchase();
        $purchase->setCustomerName('test');
        $purchase->setProduct($product);
        $purchase->setDiscount(1.1);
        $purchase->setTotal(100);
        $purchase->setQuantity(1);
        $purchase->setPurchaseDate(new \DateTime('2017-08-05'));

        $purchaseRepository = $this->createMock(ObjectRepository::class);
        $purchaseRepository->expects($this->any())
            ->method('findAll')
            ->willReturn([$purchase]);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($purchaseRepository);

        $dataManager = new DataManager($objectManager);
        $purchases = $dataManager->listAllPurchases();

        $this->assertCount(1, $purchases);
        /** @var Purchase $purchase */
        $purchase = array_shift($purchases);
        $this->assertInstanceOf(Purchase::class, $purchase);
        $this->assertEquals('test', $purchase->getCustomerName());
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(1.1, $purchase->getDiscount());
        $this->assertEquals(100, $purchase->getTotal());
        $this->assertEquals(1, $purchase->getQuantity());
        $this->assertEquals(new \DateTime('2017-08-05'), $purchase->getPurchaseDate());
    }

}
