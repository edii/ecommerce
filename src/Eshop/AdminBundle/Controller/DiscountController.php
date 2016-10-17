<?php

namespace Eshop\AdminBundle\Controller;

use Eshop\AdminBundle\Form\Type\DiscountType;
use Eshop\ShopBundle\Entity\Currency;
use Eshop\ShopBundle\Entity\Discount;
use Eshop\ShopBundle\Entity\Settings;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Discount controller.
 *
 * @Route("/admin/discount")
 */
class DiscountController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route(
     *      "/edit/{discountId}",
     *      name="admin_discount_init_ajax",
     *      requirements={"discountId" = "\d+"},
     *      defaults={"discountId" = null}
     * )
     * @param Request $request
     * @Method({"GET", "POST"})
     * @return JsonResponse
     */
    public function initAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $discountRepository = $em->getRepository('ShopBundle:Discount');

        $discount = new Discount();
        if ($request->get('relationId')) {
            $discount->setRelationId($request->request->getInt('relationId'));
        }

        if ($request->get('id')) {
            $discount = $discountRepository->find($request->get('id'));
        }

        return new JsonResponse(
            $this
                ->get('shop.form_exporter.service')
                ->get(
                    DiscountType::class,
                    $discount
                ),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @param Request $request
     * @Route("/discount_edit_ajax", name="admin_discount_edit_ajax")
     * @Method("POST")
     * @return JsonResponse
     */
    public function editAction(Request $request)
    {
        $discount = new Discount();
        $em = $this->getDoctrine()->getManager();
        $formHandlerService = $this->get('shop.form.handler');

        $form = $this->createForm(DiscountType::class, $discount);
        $form->handleRequest($request);

        $errors = $formHandlerService->getErrorMessages($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository = $em->getRepository('ShopBundle:Product');

            if ($relationId = (int)$discount->getRelationId()) {
                $product = $productRepository->findOneById($relationId);
                $discount->setProduct($product);
            }

            try {
                $em->persist($discount);
                $em->flush();
            } catch (\Exception $e) {
                return new JsonResponse([
                    'errors' => $errors
                ], JsonResponse::HTTP_BAD_REQUEST);
            }

            return new JsonResponse($discount->__toArray(), JsonResponse::HTTP_OK);
        }

        return new JsonResponse([
            'errors' => $errors
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Deletes a Discount entity.
     *
     * @Route("/delete", name="admin_discount_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->request->get('id');
        $discountRepository = $this->getDoctrine()->getRepository('ShopBundle:Discount');

        if (!empty($id)) {
            $discountRepository->delete([$id]);

            return new JsonResponse([
                'success' => true
            ], JsonResponse::HTTP_OK);
        } else {
            return new JsonResponse([
                'error' => 'Canot empty discount id.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
