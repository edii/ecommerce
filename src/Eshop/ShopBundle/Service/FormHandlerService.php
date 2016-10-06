<?php

namespace Eshop\ShopBundle\Service;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormView;

/**
 * @package Apissystem\Base\Service
 */
class FormHandlerService
{

    /**
     * Extract children attributes from FormView to Array
     *
     * @param  array|FormView $formView
     * @param  array          $fields
     * @return array
     */
    public function extract(
        $formView,
        array $fields = [
            'name',
            'full_name',
            'label',
            'value',
        ]
    ) {
        $list = [];

        if ($formView instanceof FormView) {
            $formView = $formView->children;
        }

        foreach ($formView as $child) {
            if (!(count($child->children) > 0)) {
                $item = [];

                foreach ($fields as $field) {
                    if (!isset($child->vars[$field])) {
                        continue;
                    }

                    $item[$field] = $child->vars[$field];
                }

                $list[] = $item;
            } else {
                $list = $list + $this->extract($child->children, $fields);
            }
        }

        return $list;
    }

    /**
     * @param FormInterface $form
     * @param bool          $outputTypeArray
     * @return string|array
     */
    public function getErrorMessages(FormInterface $form, $outputTypeArray = false)
    {
        $errors = [];
        /** @var $error FormError */
        foreach ($form->getErrors(true, true) as $error) {
            $invalidElementName = $error->getOrigin()->getConfig()->getOption('label');
            if (!strlen($invalidElementName)) {
                $invalidElementName = $error->getOrigin()->getName();
            }

            if (!isset($errors[$invalidElementName])) {
                $errors[$invalidElementName] = $error->getMessage();
            }
        }

        return $this->prepareResult($errors, $outputTypeArray);
    }

    /**
     * @param array $errors
     * @param bool  $outputTypeArray
     * @return string
     */
    private function prepareResult(array $errors, $outputTypeArray)
    {
        $result = $errors;
        if (!$outputTypeArray) {
            $result = '';
            foreach ($errors as $elementName => $message) {
                $result .= $elementName.': '.$message.' ';
            }
            $result = trim($result);
        }

        return $result;
    }
}
