<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\ToggleableTrait;
use Eshop\ShopBundle\Traits\IdTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\DiscountRepository")
 */
class Discount
{
    const DISCOUNT_PERCENT = 'percent';
    const DISCOUNT_CASH = 'cash';

    use IdTrait;
    use TimestampableTrait, ToggleableTrait;

    /**
     * @ORM\Column(name="number", type="float", nullable=false)
     */
    private $number;

    /**
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return float
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return $this;
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

}
