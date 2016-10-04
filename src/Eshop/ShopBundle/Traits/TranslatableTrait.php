<?php

namespace Eshop\ShopBundle\Traits;

use Doctrine\Common\Collections\ArrayCollection;

trait TranslatableTrait
{
    /**
     * @var TranslationInterface[]
     */
    protected $translations;

    /**
     * @var string
     */
    protected $currentLocale;

    /**
     * Cache current translation.
     * @var TranslationInterface
     */
    protected $currentTranslation;

    /**
     * @var string
     */
    protected $fallbackLocale;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return $this;
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * addTranslation
     * @param TranslationInterface $translation
     */
    public function addTranslation(TranslationInterface $translation)
    {
        if (!$this->translations->containsKey($translation->getLocale())) {
            $this->translations->set($translation->getLocale(), $translation);
            $translation->setTranslatable($this);
        }
    }

    /**
     * @param TranslationInterface $translation
     */
    public function removeTranslation(TranslationInterface $translation)
    {
        if ($this->translations->removeElement($translation)) {
            $translation->setTranslatable(null);
        }
    }

    /**
     * @param TranslationInterface $translation
     * @return bool
     */
    public function hasTranslation(TranslationInterface $translation)
    {
        return $this->translations->containsKey($translation->getLocale());
    }

    /**
     * @param string $currentLocale
     * @return $this;
     */
    public function setCurrentLocale($currentLocale)
    {
        $this->currentLocale = $currentLocale;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentLocale()
    {
        return $this->currentLocale;
    }

    /**
     * @param string $fallbackLocale
     * @return $this;
     */
    public function setFallbackLocale($fallbackLocale)
    {
        $this->fallbackLocale = $fallbackLocale;

        return $this;
    }

    /**
     * @return string
     */
    public function getFallbackLocale()
    {
        return $this->fallbackLocale;
    }

    /**
     * @param string|null $locale
     * @return mixed
     */
    public function translate($locale = null)
    {
        $locale = $locale ?: $this->currentLocale;
        if (null === $locale) {
            throw new \RuntimeException('No locale has been set and current locale is undefined.');
        }
        if ($this->currentTranslation && $locale === $this->currentTranslation->getLocale()) {
            return $this->currentTranslation;
        }
        if (!$translation = $this->translations->get($locale)) {
            if (null === $this->fallbackLocale) {
                throw new \RuntimeException('No fallback locale has been set.');
            }
            if (!$fallbackTranslation = $this->translations->get($this->getFallbackLocale())) {
                $className = $this->getTranslationClass();
                /** @var TranslationInterface $translation */
                $translation = new $className();
                $translation->setLocale($locale);
                $this->addTranslation($translation);
            } else {
                $translation = clone $fallbackTranslation;
            }
        }
        $this->currentTranslation = $translation;

        return $translation;
    }

    /**
     * Return translation model class.
     *
     * @return string
     */
    public static function getTranslationClass()
    {
        return get_called_class().'Translation';
    }
}