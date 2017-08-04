<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 13:10
 */

namespace APIBundle\Manager;

use Doctrine\ORM\EntityManager;

class DataManager
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DataManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @return array|\TMSHomeworkBundle\Entity\Purchase[]
     */
    public function listAllPurchases()
    {
        return $this->entityManager
            ->getRepository('TMSHomeworkBundle:Purchase')
            ->findAll();
    }
}