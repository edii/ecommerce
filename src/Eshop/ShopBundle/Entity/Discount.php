<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\EnableableTrait;
use Eshop\ShopBundle\Traits\IdTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\DiscountRepository")
 */
class Discount
{
    const DISCOUNT_PERCENT = 'percent';
    const DISCOUNT_CASH = 'cash';

    use IdTrait;
    use TimestampableTrait;

    /**
     * @var integer
     * @ORM\Column(name="number", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $number;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    protected $type;

    /**
     * @var float
     * @ORM\Column(name="amount_discount", type="float")
     */
    protected $amountDiscount = 0.0;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Eshop\ShopBundle\Entity\Currency",
     *     inversedBy="discount"
     * )
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    protected $currency;

    /**
     * @var \DateTime
     * @ORM\Column(name="valid_from", type="datetime", nullable=true)
     */
    protected $validFrom             = null;

    /**
     * @var \DateTime
     * @ORM\Column(name="valid_to", type="datetime", nullable=true)
     */
    protected $validTo               = null;

    /**
     * @ORM\ManyToOne(targetEntity="Eshop\ShopBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @var integer
     */
    protected $relationId;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * @param \DateTime|null $validFrom
     * @return $this
     */
    public function setValidFrom(\DateTime $validFrom = null)
    {
        if (null !== $validFrom) {
            $validFrom = $validFrom->setTime(0, 0, 0);
        }

        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param \DateTime|null $validTo
     * @return $this
     */
    public function setValidTo(\DateTime $validTo = null)
    {
        if (null !== $validTo) {
            $validTo = $validTo->setTime(23, 59, 59);
        }

        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDiscountValid()
    {
        $now = new \DateTime();

        if ($this->validFrom instanceof \DateTime && $this->validTo instanceof \DateTime) {
            return ($this->validFrom <= $now) && ($this->validTo >= $now);
        }

        return false;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmountDiscount()
    {
        return $this->amountDiscount;
    }

    /**
     * @param float $amountDiscount
     * @return $this
     */
    public function setAmountDiscount($amountDiscount)
    {
        $this->amountDiscount = $amountDiscount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelationId()
    {
        return $this->relationId;
    }

    /**
     * @param integer $relationId
     * @return Discount
     */
    public function setRelationId($relationId)
    {
        $this->relationId = $relationId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return Discount
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }
}
