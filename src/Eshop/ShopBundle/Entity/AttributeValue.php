<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\ToggleableTrait;
use Eshop\ShopBundle\Traits\NameTrait;
use Eshop\ShopBundle\Traits\IdTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\AttributeValueRepository")
 */
class AttributeValue
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
     * @var Collection
     */
    protected $attributes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->attributes = new ArrayCollection();
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
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    /**
     * {@inheritdoc}
     */
    public function setAttributes(Collection $attributes)
    {
        $this->syncOldAttributes($attributes);
        $this->syncNewAttributes($attributes);
    }

    public function addAttribute($attribute)
    {
        $this->attributes->add($attribute);
        $attribute->addValue($this);
    }

    protected function syncOldAttributes(Collection $attributes)
    {
        $this->attributes->map(function ($attribute) use ($attributes) {
            if (false === $attributes->contains($attribute)) {
                $attribute->removeValue($this);
            }
        });
    }

    protected function syncNewAttributes(Collection $attributes)
    {
        $attributes->map(function ($attribute) {
            if (false === $this->attributes->contains($attribute)) {
                $attribute->addValue($this);
            }
        });
    }
}
