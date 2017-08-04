<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 03/08/17
 * Time: 20:46
 */

namespace TMSHomeworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="purchase")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Purchase
{
    const SERIALIZATION_GROUP_PURCHASE = 'purchase';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Type("string")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $customerName;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="purchases")
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     *
     * @Serializer\Type("TMSHomeworkBundle\Entity\Product")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     *
     * @Serializer\Type("integer")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     * @Assert\GreaterThanOrEqual(0)
     *
     * @Serializer\Type("float")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $discount;

    /**
     * @ORM\Column(type="float")
     * @Assert\GreaterThan(0)
     *
     * @Serializer\Type("float")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $total;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThanOrEqual("now")
     *
     * @Serializer\Type("DateTime")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $purchaseDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName(string $customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total)
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @param \DateTime $purchaseDate
     */
    public function setPurchaseDate(\DateTime $purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }
}