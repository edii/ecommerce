<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\ToggleableTrait;
use Eshop\ShopBundle\Traits\IdTrait;
use Eshop\ShopBundle\Traits\EnableableTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\VariantOptionRepository")
 */
class VariantOption
{
    use IdTrait;

//    /**
//     * @var VariantInterface
//     */
//    protected $variant;
//
//    /**
//     * @var AttributeInterface
//     */
//    protected $attribute;
//
//    /**
//     * @var AttributeValueInterface
//     */
//    protected $attributeValue;
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getVariant() : VariantInterface
//    {
//        return $this->variant;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function setVariant(VariantInterface $variant)
//    {
//        $this->variant = $variant;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getAttribute() : AttributeInterface
//    {
//        return $this->attribute;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function setAttribute(AttributeInterface $attribute)
//    {
//        $this->attribute = $attribute;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getAttributeValue() : AttributeValueInterface
//    {
//        return $this->attributeValue;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function setAttributeValue(AttributeValueInterface $attributeValue)
//    {
//        $this->attributeValue = $attributeValue;
//    }
}
