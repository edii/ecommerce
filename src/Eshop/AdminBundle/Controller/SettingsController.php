<?php

namespace Eshop\AdminBundle\Controller;

use Eshop\ShopBundle\Entity\Settings;
use Eshop\ShopBundle\Form\Type\SettingType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Settings controller.
 *
 * @Route("/admin/settings")
 */
class SettingsController extends Controller
{

    /**
     * Show current settings.
     *
     * @Route("/", name="admin_settings")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $settingRepository = $em->getRepository('ShopBundle:Settings');

        $setting = new Settings();
        if ($entity = $settingRepository->findOneByResult()) {
            $setting = $entity;
        }

        $form = $this->createForm(
            'Eshop\ShopBundle\Form\Type\SettingType',
            $setting
        );
        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @param Request $request
     * @Route("/settings_edit", name="admin_settings_edit")
     * @Method("POST")
     * @return JsonResponse
     */
    public function settingsEditAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $settingRepository = $em->getRepository('ShopBundle:Settings');
        $data = $request->get('setting');

        $setting = new Settings();
        if ($data['id']) {
            $setting = $settingRepository->findOneBy(['id' => $data['id']]);
        }

        $form = $this->get('form.factory')
            ->create(SettingType::class, $setting)
            ->submit($data);

        if ($form->isValid()) {
            $em->persist($setting);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_settings'));
    }
}
