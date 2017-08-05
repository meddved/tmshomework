<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 10:11
 */

namespace APIBundle\Controller;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use TMSHomeworkBundle\Entity\Purchase;

class PurchaseController extends FOSRestController
{
    /**
     * @return Response
     */
    public function listAction()
    {
        $purchases = $this->get('tms_api.manager.data_manager')->listAllPurchases();

        $context = new Context();
        $context->setGroups([Purchase::SERIALIZATION_GROUP_PURCHASE]);
        $context->setSerializeNull(true);

        $view = $this->view($purchases, Response::HTTP_OK)->setContext($context);

        return $this->handleView($view);
    }
}
