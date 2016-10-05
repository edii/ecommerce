<?php
namespace Eshop\ShopBundle\Service;

use Doctrine\ORM\EntityManager;
use Eshop\ShopBundle\Entity\Currency;
use Eshop\ShopBundle\Entity\Settings;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingsService
{
    /**
     * @var Settings $settings
     */
    private $settings;

    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * Container
     *
     * @var
     */
    private $container;

    /**
     * SettingsService constructor.
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $entityManager, $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
        $this->settings = $this->em->getRepository('ShopBundle:Settings')->findOneByResult();
    }

    /**
     * @return bool
     */
    public function getShowEmptyManufacturers(){
        return $this->settings->getShowEmptyManufacturers();
    }

    /**
     * @return bool
     */
    public function getShowEmptyCategories(){
        return $this->settings->getShowEmptyCategories();
    }

    /**
     * @return bool
     */
    public function getDefaultCurrency(){

        if ($this->settings->getDefaultCurrency() === null) {
            $currency = new Currency();
            $currency->setCode($this->container->getParameter('currency'));
            $currency->setSymbol($this->container->getParameter('currency_symbol'));
            $this->settings->setDefaultCurrency($currency);
        }

        return $this->settings->getDefaultCurrency();
    }
}
