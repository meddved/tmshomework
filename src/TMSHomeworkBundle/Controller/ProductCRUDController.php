<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 15:01
 */

namespace TMSHomeworkBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TMSHomeworkBundle\Entity\Product;
use TMSHomeworkBundle\Form\Type\ProductEntryType;

class ProductCRUDController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/product/create", name="tms_product_page_create")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(ProductEntryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var $product Product */
            $product = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            // for now
            return $this->redirectToRoute('tms_product_page_list_all');

        }

        return $this->render('TMSHomeworkBundle:ProductCRUD:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/product/list", name="tms_product_page_list_all")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $products = $entityManager->getRepository('TMSHomeworkBundle:Product')->findAll();

        return $this->render('TMSHomeworkBundle:ProductCRUD:list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     *
     * @Route("/product/edit/{id}", name="tms_product_page_edit")
     * @ParamConverter("product", class="TMSHomeworkBundle:Product")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Product $product)
    {
        $form = $this->createForm(ProductEntryType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // for now
            return $this->redirectToRoute('tms_product_page_list_all');

        }

        return $this->render('TMSHomeworkBundle:ProductCRUD:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param Product $product
     *
     * @Route("/product/delete/{id}", name="tms_product_page_delete")
     * @ParamConverter("product", class="TMSHomeworkBundle:Product")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Product $product)
    {
        if ($product === null) {
            return $this->redirectToRoute('tms_product_page_list_all');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('tms_product_page_list_all');
    }
}
