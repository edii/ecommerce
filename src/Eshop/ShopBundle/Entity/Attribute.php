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
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\AttributeRepository")
 */
class Attribute
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
    protected $groups;

    /**
     * @var Collection
     */
    protected $values;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->groups = new ArrayCollection();
        $this->values = new ArrayCollection();
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
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * {@inheritdoc}
     */
    public function setGroups(Collection $groups)
    {
        $this->groups->map(function ($group) use ($groups) {
            if (false === $groups->contains($group)) {
                $group->removeAttribute($this);
            }
        });

        $groups->map(function ($group) {
            if (false === $this->groups->contains($group)) {
                $group->addAttribute($this);
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function addGroup($group)
    {
        $this->groups->add($group);
        $group->addAttribute($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function setValues(Collection $collection)
    {
        $this->values = $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue($value)
    {
        $this->values->removeElement($value);
    }

    /**
     * {@inheritdoc}
     */
    public function addValue($value)
    {
        $this->values->add($value);
    }
}
