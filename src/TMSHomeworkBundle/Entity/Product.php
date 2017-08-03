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

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
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
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $price;

    /**
     * One Product can be purchased many times
     *
     * @param Purchase[]
     *
     * @ORM\OneToMany(targetEntity="TMSHomeworkBundle\Entity\Purchase", mappedBy="product")
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
     * @return Purchase[]
     */
    public function getPurchases() : array
    {
        return $this->purchases;
    }

    /**
     * @param Purchase[] $purchases
     */
    public function setPurchases($purchases)
    {
        $this->purchases = $purchases;
    }

}