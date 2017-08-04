<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 03/08/17
 * Time: 17:12
 */

namespace TMSHomeworkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @Serializer\Type("string")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     *
     * @Serializer\Type("float")
     * @Serializer\Groups({"purchase"})
     * @Serializer\Expose("true")
     */
    private $price;

    /**
     * One Product can be purchased many times
     *
     * @param Purchase[]
     *
     * @ORM\OneToMany(targetEntity="TMSHomeworkBundle\Entity\Purchase", mappedBy="product", cascade={"remove"})
     */
    private $purchases;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param Purchase $purchase
     *
     * @return Product
     */
    public function addPurchase(Purchase $purchase) : Product
    {
        $this->purchases[] = $purchase;
        return $this;
    }

    /**
     * @param Purchase $purchase
     */
    public function removePurchase(Purchase $purchase)
    {
        $this->purchases->removeElement($purchase);
    }

    /**
     * @return ArrayCollection
     */
    public function getPurchases() : ArrayCollection
    {
        return $this->purchases;
    }

}
