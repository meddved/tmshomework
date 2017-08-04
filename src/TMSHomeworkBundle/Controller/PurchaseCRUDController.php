<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 17:05
 */

namespace TMSHomeworkBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TMSHomeworkBundle\Entity\Purchase;
use TMSHomeworkBundle\Form\Type\PurchaseEntryType;

class PurchaseCRUDController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/purchase/create", name="tms_purchase_page_create")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(PurchaseEntryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var $purchase Purchase */
            $purchase = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($purchase);
            $entityManager->flush();

            return $this->redirectToRoute('tms_purchase_page_list_all');

        }

        return $this->render('TMSHomeworkBundle:ProductCRUD:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/purchase/list", name="tms_purchase_page_list_all")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $purchases = $entityManager->getRepository('TMSHomeworkBundle:Purchase')->findAll();

        return $this->render('TMSHomeworkBundle:PurchaseCRUD:list.html.twig', [
            'purchases' => $purchases,
        ]);
    }

    /**
     * @param Request $request
     * @param Purchase $purchase
     *
     * @Route("/purchase/edit/{id}", name="tms_purchase_page_edit")
     * @ParamConverter("purchase", class="TMSHomeworkBundle:Purchase")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Purchase $purchase)
    {
        $form = $this->createForm(PurchaseEntryType::class, $purchase);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('tms_purchase_page_list_all');

        }

        return $this->render('TMSHomeworkBundle:PurchaseCRUD:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param Purchase $purchase
     *
     * @Route("/purchase/delete/{id}", name="tms_purchase_page_delete")
     * @ParamConverter("purchase", class="TMSHomeworkBundle:Purchase")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Purchase $purchase)
    {
        if ($purchase === null) {
            return $this->redirectToRoute('tms_purchase_page_list_all');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($purchase);
        $entityManager->flush();

        return $this->redirectToRoute('tms_purchase_page_list_all');
    }
}
