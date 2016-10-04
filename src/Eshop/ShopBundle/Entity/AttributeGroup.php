<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Eshop\ShopBundle\Traits\TimestampableTrait;
use Eshop\ShopBundle\Traits\ToggleableTrait;
use Eshop\ShopBundle\Traits\NameTrait;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\AttributeGroupRepository")
 */
class AttributeGroup
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
        if ($this->attributes instanceof Collection) {
            $this->attributes->map(function ($attribute) use ($attributes) {
                if (false === $attributes->contains($attribute)) {
                    $this->removeAttribute($attribute);
                }
            });
        }
        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttribute($attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute($attribute)
    {
        $this->attributes->add($attribute);
    }
}
