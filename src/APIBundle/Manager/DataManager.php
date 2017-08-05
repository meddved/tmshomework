<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 13:10
 */

namespace APIBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class DataManager
{

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * DataManager constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }


    /**
     * @return array|\TMSHomeworkBundle\Entity\Purchase[]
     */
    public function listAllPurchases()
    {
        return $this->objectManager
            ->getRepository('TMSHomeworkBundle:Purchase')
            ->findAll();
    }
}