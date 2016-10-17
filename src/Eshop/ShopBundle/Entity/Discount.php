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
     * @var string
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    protected $type;

    /**
     * @var float
     * @ORM\Column(name="amount", type="float")
     */
    protected $amount = 0.0;

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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

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

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'id' => $this->getId(),
            'amount' => $this->getAmount(),
            'type' => $this->getType(),
            'valid_from' => $this->getValidFrom(),
            'valid_to' => $this->getValidTo(),
        ];
    }
}
