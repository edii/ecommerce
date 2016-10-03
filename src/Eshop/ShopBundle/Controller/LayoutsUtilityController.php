<?php

namespace Eshop\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LayoutsUtilityController extends Controller
{
    /**
     * render categories menu
     */
    public function categoriesMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('ShopBundle:Category');

        // $settings = $this->get('app.site_settings');
        // $showEmpty = $settings->getShowEmptyCategories();

//        $options = array('decorate' => false);
//        $tree = $categoryRepository->buildTree($categoryRepository->getAllTreeQB()->getArrayResult(), $options);
//
//        echo "<pre>";
//        var_dump($tree);
//        echo "</pre>";

        $htmlTree = $categoryRepository->childrenHierarchy(
            null,
            false,
            [
                'decorate' => true,
                'rootOpen' => '<ul>',
                'rootClose' => '</ul>',
                'childOpen' => '<li>',
                'childClose' => '</li>',
                'nodeDecorator' => function($node) {
                    $href = $this->generateUrl('category', ['slug' => $node['slug']]);
                    return '<a href="'.$href.'" class="list-group-item menu-link">'.$node['name'].'</a>';
                }
            ]
        );

        return $this->render(
            'ShopBundle:Partials:categoriesMenu.html.twig',
            [
                'htmlTree' => $htmlTree,
            ]
        );
    }

    /**
     * render manufacturers menu
     */
    public function manufacturersMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $manufacturerRepository = $em->getRepository('ShopBundle:Manufacturer');

        $settings = $this->get('app.site_settings');
        $showEmpty = $settings->getShowEmptyManufacturers();

        $manufacturers = $manufacturerRepository->getAllManufacturers($showEmpty);

        return $this->render('ShopBundle:Partials:manufacturersMenu.html.twig',
            array('manufacturers' => $manufacturers));
    }

    /**
     * render top menu with static pages headers.
     */
    public function staticPagesMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $headers = $em->getRepository('ShopBundle:StaticPage')->getHeaders();
        return $this->render('ShopBundle:Partials:staticPagesMenu.html.twig',
            array('headers' => $headers));
    }
}
