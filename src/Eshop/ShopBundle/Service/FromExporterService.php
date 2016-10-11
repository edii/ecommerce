<?php

namespace Eshop\ShopBundle\Service;

use JMS\Serializer\SerializationContext;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class FromExporterService
 *
 * @package Apissystem\Base\Service
 */
class FromExporterService
{
    private $serializer;

    private $factory;

    /**
     * @param SerializerInterface  $serializer
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(SerializerInterface $serializer, FormFactoryInterface $formFactory)
    {
        $this->serializer = $serializer;
        $this->factory = $formFactory;
    }

    /**
     * Export form to array
     *
     * @param  string|FormTypeInterface $form The type of the form
     * @param  array                    $data
     * @return mixed
     */
    public function get($form, $data = [])
    {
        return json_decode($this->serializer->serialize(
            $this->factory->create($form, $data)->createView(),
            'json',
            SerializationContext::create()->enableMaxDepthChecks()
        ), true);
    }
}
