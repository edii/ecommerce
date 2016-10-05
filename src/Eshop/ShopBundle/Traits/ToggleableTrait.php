<?php

namespace Eshop\ShopBundle\Traits;

trait ToggleableTrait
{
    /**
     * @var array $enable
     */
    public static $enableStatus = [
        true => 'Enabled',
        false => 'Disabled',
    ];

    /**
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    protected $enabled = true;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;

        return $this;
    }

    /**
     * @return $this
     */
    public function enable()
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function disable()
    {
        $this->enabled = false;

        return $this;
    }

    public static function getEnabledStatus($enabled)
    {
        return (isset(self::$enableStatus[$enabled]))?self::$enableStatus[$enabled]:'Disabled';
    }
}