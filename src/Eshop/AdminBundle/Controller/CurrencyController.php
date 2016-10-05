<?php

namespace Eshop\AdminBundle\Controller;

use Eshop\ShopBundle\Entity\Currency;
use Eshop\ShopBundle\Entity\Settings;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Currency controller.
 *
 * @Route("/admin/settings")
 */
class CurrencyController extends Controller
{

    /**
     * @Route("/", name="admin_currency")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $currencyRepository = $em->getRepository('ShopBundle:Currency');
        $paginator = $this->get('knp_paginator');

        $qb = $currencyRepository->getAllCurrenciesAdminQB();
        $limit = $this->getParameter('admin_currencies_pagination_count');

        $currencies = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            $limit
        );

        return array(
            'entities' => $currencies,
        );
    }

    /**
     * @Route("/new", name="admin_currency_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $currency = new Currency();
        $form = $this->createForm('Eshop\ShopBundle\Form\Type\CurrencyType', $currency);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('admin_currency_show', array('id' => $currency->getId()));
        }

        return array(
            'entity' => $currency,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{id}", name="admin_currency_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);
        return array(
            'entity' => $currency,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("/{id}/edit", name="admin_currency_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);
        $editForm = $this->createForm('Eshop\ShopBundle\Form\Type\CurrencyType', $currency);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($currency);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('admin_currency_edit', array('id' => $currency->getId()));
        }

        return array(
            'entity' => $currency,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}", name="admin_currency_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Currency $currency)
    {
        $form = $this->createDeleteForm($currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($currency);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_currency'));
    }

    /**
     * @param Currency $currency
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Currency $currency)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_currency_delete', array('id' => $currency->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
