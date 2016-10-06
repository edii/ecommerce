<?php

namespace Eshop\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="Eshop\ShopBundle\Repository\SettingsRepository")
 */
class Settings
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="show_empty_categories", type="boolean", nullable=true)
     */
    protected $showEmptyCategories;

    /**
     * @var bool
     *
     * @ORM\Column(name="show_empty_manufacturers", type="boolean", nullable=true)
     */
    protected $showEmptyManufacturers;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Eshop\ShopBundle\Entity\Currency"
     * )
     */
    protected $defaultCurrency;

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
     * Set id
     * @param integer $id
     * @return integer
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set showEmptyCategories
     *
     * @param boolean $showEmptyCategories
     * @return Settings
     */
    public function setShowEmptyCategories($showEmptyCategories)
    {
        $this->showEmptyCategories = $showEmptyCategories;

        return $this;
    }

    /**
     * Get showEmptyCategories
     *
     * @return boolean 
     */
    public function getShowEmptyCategories()
    {
        return $this->showEmptyCategories;
    }

    /**
     * Set showEmptyManufacturers
     *
     * @param boolean $showEmptyManufacturers
     * @return Settings
     */
    public function setShowEmptyManufacturers($showEmptyManufacturers)
    {
        $this->showEmptyManufacturers = $showEmptyManufacturers;

        return $this;
    }

    /**
     * Get showEmptyManufacturers
     *
     * @return boolean 
     */
    public function getShowEmptyManufacturers()
    {
        return $this->showEmptyManufacturers;
    }

    /**
     * @return string
     */
    public function getDefaultCurrency()
    {
        return $this->defaultCurrency;
    }

    /**
     * @param string $defaultCurrency
     * @return $this
     */
    public function setDefaultCurrency($defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;

        return $this;
    }
}
