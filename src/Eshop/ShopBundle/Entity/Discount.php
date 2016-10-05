<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\EnableableTrait;
use Eshop\ShopBundle\Traits\IdTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\DiscountRepository")
 */
class Discount
{
    use IdTrait;
    use TimestampableTrait, EnableableTrait;

    /**
     * @var float
     * @ORM\Column(name="discounted_net_amount", type="float")
     */
    protected $discountedNetAmount   = 0.00;

    /**
     * @var float
     * @ORM\Column(name="discounted_gross_amount", type="float")
     */
    protected $discountedGrossAmount = 0.00;

    /**
     * @var float
     * @ORM\Column(name="discounted_tax_amount", type="float")
     */
    protected $discountedTaxAmount   = 0.00;

    /**
     * @var \DateTime
     * @ORM\Column(name="valid_from", type="datetime")
     */
    protected $validFrom             = null;

    /**
     * @var \DateTime
     * @ORM\Column(name="valid_to", type="datetime")
     */
    protected $validTo               = null;

    /**
     * @var float
     * @ORM\Column(name="net_amount", type="float")
     */
    protected $netAmount    = 0;

    /**
     * @var float
     * @ORM\Column(name="gross_amount", type="float")
     */
    protected $grossAmount  = 0;

    /**
     * @var float
     * @ORM\Column(name="tax_amount", type="float")
     */
    protected $taxAmount    = 0;

    /**
     * @var float
     * @ORM\Column(name="tax_rate", type="float")
     */
    protected $taxRate      = 0;

    /**
     * @var string
     * @ORM\Column(name="currency", type="string")
     */
    protected $currency     = '';

    protected $exchangeRate = 0;

    /**
     * @return float
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * @param float $netAmount
     * @return $this
     */
    public function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * @param float $grossAmount
     * @return $this
     */
    public function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param float $taxAmount
     * @return $this
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param float $taxRate
     * @return $this
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

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
     * @return float
     */
    public function getFinalGrossAmount()
    {
        if ($this->isDiscountValid()) {
            return $this->getDiscountedGrossAmount();
        }

        return $this->getGrossAmount();
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
     * @return float
     */
    public function getDiscountedGrossAmount()
    {
        return $this->discountedGrossAmount;
    }

    /**
     * @param float $discountedGrossAmount
     * @return $this
     */
    public function setDiscountedGrossAmount($discountedGrossAmount)
    {
        $this->discountedGrossAmount = $discountedGrossAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getFinalNetAmount()
    {
        if ($this->isDiscountValid()) {
            return $this->getDiscountedNetAmount();
        }

        return $this->getNetAmount();
    }

    /**
     * @return float
     */
    public function getDiscountedNetAmount()
    {
        return $this->discountedNetAmount;
    }

    /**
     * @param float $discountedNetAmount
     * @return $this
     */
    public function setDiscountedNetAmount($discountedNetAmount)
    {
        $this->discountedNetAmount = $discountedNetAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getFinalTaxAmount()
    {
        if ($this->isDiscountValid()) {
            return $this->getDiscountedTaxAmount();
        }

        return $this->getTaxAmount();
    }

    /**
     * @return float
     */
    public function getDiscountedTaxAmount()
    {
        return $this->discountedTaxAmount;
    }

    /**
     * @param float $discountedTaxAmount
     * @return $this
     */
    public function setDiscountedTaxAmount($discountedTaxAmount)
    {
        $this->discountedTaxAmount = $discountedTaxAmount;

        return $this;
    }
}
