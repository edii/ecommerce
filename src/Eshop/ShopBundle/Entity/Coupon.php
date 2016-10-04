<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\ToggleableTrait;
use Eshop\ShopBundle\Traits\IdTrait;
use Eshop\ShopBundle\Traits\NameTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\CouponRepository")
 */
class Coupon
{
    use IdTrait, NameTrait;
    use TimestampableTrait, ToggleableTrait;

    /**
     * @var string
     * @ORM\Column(name="code", type="string", length=255)
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column(name="currency", type="string", length=255)
     */
    protected $currency;

    /**
     * @var string
     * @ORM\Column(name="modifierType", type="string", length=255)
     */
    protected $modifierType;

    /**
     * @var int|float
     * @ORM\Column(type="float")
     */
    protected $modifierValue;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $validFrom;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $validTo;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $clientUsageLimit;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $globalUsageLimit;

    /**
     * Code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
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
     * @return string
     */
    public function getModifierType()
    {
        return $this->modifierType;
    }

    /**
     * @param string $modifierType
     * @return $this
     */
    public function setModifierType($modifierType)
    {
        $this->modifierType = $modifierType;

        return $this;
    }

    /**
     * @return float
     */
    public function getModifierValue()
    {
        return $this->modifierValue;
    }

    /**
     * @param float $modifierValue
     * @return $this
     */
    public function setModifierValue($modifierValue)
    {
        $this->modifierValue = $modifierValue;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidFrom(\DateTime $validFrom = null)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidTo(\DateTime $validTo = null)
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return integer
     */
    public function getClientUsageLimit()
    {
        return $this->clientUsageLimit;
    }

    /**
     * @param integer $clientUsageLimit
     * @return $this
     */
    public function setClientUsageLimit($clientUsageLimit)
    {
        $this->clientUsageLimit = $clientUsageLimit;

        return $this;
    }

    /**
     * @return integer
     */
    public function getGlobalUsageLimit()
    {
        return $this->globalUsageLimit;
    }

    /**
     * @param integer $globalUsageLimit
     * @return $this
     */
    public function setGlobalUsageLimit($globalUsageLimit)
    {
        $this->globalUsageLimit = $globalUsageLimit;

        return $this;
    }
}
