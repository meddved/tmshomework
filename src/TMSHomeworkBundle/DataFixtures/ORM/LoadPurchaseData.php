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
use TMSHomeworkBundle\Entity\Purchase;

class LoadPurchaseData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $products = $manager->getRepository('TMSHomeworkBundle:Product')->findAll();

        foreach ($products as $product) {
            $purchase = new Purchase();
            $purchase->setCustomerName('name');
            $purchase->setPurchaseDate(new \DateTime());
            $purchase->setQuantity(4);
            $purchase->setTotal($product->getPrice() * $purchase->getQuantity());
            $purchase->setDiscount(2.5);
            $purchase->setProduct($product);

            $manager->persist($purchase);

            $product->addPurchase($purchase);
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
        return 3;
    }
}