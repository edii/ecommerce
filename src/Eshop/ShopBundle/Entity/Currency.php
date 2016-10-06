<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\ToggleableTrait;
use Eshop\ShopBundle\Traits\IdTrait;
use Eshop\ShopBundle\Traits\NameTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\CurrencyRepository")
 */
class Currency
{
    use NameTrait;
    use TimestampableTrait, ToggleableTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=255, nullable=true, unique=true)
     */
    private $symbol;

    /**
     * @var string
     *
     * @ORM\Column(name="exchange_rate", type="float", nullable=false)
     */
    private $exchangeRate = 0.0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default_currency", type="boolean")
     */
    private $defaultCurrency;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Eshop\ShopBundle\Entity\Settings",
     *     mappedBy="defaultCurrency"
     * )
     */
    private $setting;

    /**
     * @ORM\OneToMany(targetEntity="Eshop\ShopBundle\Entity\Discount", mappedBy="currency")
     **/
    protected $discount;

    /**
     * @ORM\OneToMany(targetEntity="Eshop\ShopBundle\Entity\Product", mappedBy="currency")
     **/
    protected $product;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->setting = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * ExchangeRate
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param float $rate
     * @return Currency
     */
    public function setExchangeRate($rate)
    {
        $this->exchangeRate = $rate;

        return $this;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return $this
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * @param mixed $setting
     * @return $this;
     */
    public function setSetting($setting)
    {
        $this->setting = $setting;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDefaultCurrency()
    {
        return $this->defaultCurrency;
    }

    /**
     * @param boolean $defaultCurrency
     * @return $this
     */
    public function setDefaultCurrency($defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;

        return $this;
    }
}
