<?php

namespace Application\View\Helper;

use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\FormElementErrors;

class Bs4FormElementErrors extends FormElementErrors
{
    public function __construct()
    {
        $this->setMessageOpenFormat('<div class="invalid-feedback">');
        $this->setMessageSeparatorString('</div><div class="invalid-feedback">');
        $this->setMessageCloseString('</div>');
    }
}
