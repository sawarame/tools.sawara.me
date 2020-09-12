<?php

namespace Application\View\Helper;

use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\FormElement;

/**
 * Form element render for BootStrap4.
 */
class Bs4FormElement extends FormElement
{
    /**
     * Render an element
     *
     * Introspects the element type and attributes to determine which
     * helper to utilize when rendering.
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        if ($element->getMessages()) {
            $class = $element->getAttribute('class');
            $element->setAttribute('class', $class . ' is-invalid');
        }
        return parent::render($element);
    }
}
