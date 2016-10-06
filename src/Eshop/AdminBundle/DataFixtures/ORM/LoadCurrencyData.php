<?php
namespace Eshop\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eshop\ShopBundle\Entity\Currency;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCurrencyData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $currency = new Currency();

        $currency->setName("Гривня");
        $currency->setCode("UAH");
        $currency->setSymbol("грн.");
        $currency->setDefaultCurrency(true);
        $currency->setEnabled(true);

        $manager->persist($currency);
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}