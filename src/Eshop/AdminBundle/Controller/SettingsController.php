<?php

namespace Eshop\AdminBundle\Controller;

use Eshop\ShopBundle\Entity\Settings;
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

        var_dump($setting);
        die('stop');


//        $em = $this->getDoctrine()->getManager();
//        $settingRepository = $em->getRepository('ShopBundle:Settings');
//
//        die(var_dump($request->request->all()));
//
//        $entities = $settingRepository->findAll();
//        /**
//         * @var Settings $settings
//         */
//        $settings = $entities[0];
//
//
//        $editingSetting = $request->get('editing_setting');
//        $newValue = $request->request->getBoolean('new_value');
//
//        switch ($editingSetting) {
//            case 'show_empty_categories';
//                $settings->setShowEmptyCategories($newValue);
//                break;
//            case 'show_empty_manufacturers';
//                $settings->setShowEmptyManufacturers($newValue);
//                break;
//        }
//
//        $em->flush();
//
//        return new JsonResponse(
//            array('success' => true)
//        );
    }
}
