<?php

namespace Eshop\ShopBundle\Traits;

trait EnableableTrait
{
    /**
     * @var array $enable
     */
    public static $enableStatus = [
        true => 'Enabled',
        false => 'Disabled',
    ];

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    protected $enabled;

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public static function getEnabledStatus($enabled)
    {
        return (isset(self::$enableStatus[$enabled]))?self::$enableStatus[$enabled]:'Disabled';
    }
}