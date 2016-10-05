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
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\VariantRepository")
 */
class Variant
{
    use IdTrait, EnableableTrait;
    use TimestampableTrait;

//    /**
//     * @var Collection
//     */
//    protected $options;
//    /**
//     * @var DiscountablePrice
//     */
//    protected $sellPrice;
//    /**
//     * @var float
//     */
//    protected $weight;
//    /**
//     * @var string
//     */
//    protected $symbol;
//    /**
//     * @var int
//     */
//    protected $stock;
//    /**
//     * @var string
//     */
//    protected $modifierType;
//    /**
//     * @var float
//     */
//    protected $modifierValue;
//
//    public function __construct()
//    {
//        $this->createdAt = new \DateTime();
//        $this->options = new ArrayCollection();
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getOptions()
//    {
//        return $this->options;
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function setOptions(Collection $options)
//    {
//        if ($this->options instanceof Collection) {
//            $this->synchronizeOptions($options);
//        }
//        $this->options = $options;
//    }
//
//    protected function synchronizeOptions(Collection $options)
//    {
//        $this->options->map(function ($option) use ($options) {
//            if (false === $options->contains($option)) {
//                $this->options->removeElement($option);
//            }
//        });
//    }
//
//    /**
//     * @return float
//     */
//    public function getWeight()
//    {
//        return $this->weight;
//    }
//
//    /**
//     * @param
//     */
//    public function setWeight(float $weight)
//    {
//        $this->weight = $weight;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function getSymbol() : string
//    {
//        return $this->symbol;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function setSymbol(string $symbol)
//    {
//        $this->symbol = $symbol;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function getStock() : int
//    {
//        return $this->stock;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function setStock(int $stock)
//    {
//        $this->stock = $stock;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function getSellPrice() : DiscountablePrice
//    {
//        return $this->sellPrice;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function setSellPrice(DiscountablePrice $sellPrice)
//    {
//        $this->sellPrice = $sellPrice;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function getModifierValue() : float
//    {
//        return $this->modifierValue;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function setModifierValue(float $modifierValue)
//    {
//        $this->modifierValue = $modifierValue;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function getModifierType() : string
//    {
//        return $this->modifierType;
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function setModifierType(string $modifierType)
//    {
//        $this->modifierType = $modifierType;
//    }
}
