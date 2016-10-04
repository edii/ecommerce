<?php

namespace Eshop\ShopBundle\Traits;

interface TranslatableInterface
{
    /**
     * Translation helper method.
     *
     * @param string $locale
     * @return TranslationInterface
     * @throws \RuntimeException
     */
    public function translate($locale = null);

    /**
     * @param TranslationInterface $translation
     * @return bool
     */
    public function hasTranslation(TranslationInterface $translation);

    /**
     * @param string $locale
     */
    public function setCurrentLocale($locale);

    /**
     * @param string $locale
     */
    public function setFallbackLocale($locale);

    /**
     * @return TranslationInterface[]
     */
    public function getTranslations();

    /**
     * @param TranslationInterface $translation
     */
    public function addTranslation(TranslationInterface $translation);

    /**
     * @param TranslationInterface $translation
     */
    public function removeTranslation(TranslationInterface $translation);
}