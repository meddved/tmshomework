<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 12:41
 */

namespace TMSHomeworkBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use TMSHomeworkBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $productsList = [
        [
            'name' => 'product1',
            'price' => 100
        ],
        [
            'name' => 'product2',
            'price' => 200
        ],
        [
            'name' => 'product3',
            'price' => 300
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->productsList as $productList) {
            $product = new Product();
            $product->setName($productList['name']);
            $product->setPrice($productList['price']);

            $manager->persist($product);
        }

        $manager->flush();
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}