<?php

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Filter;
use Laminas\Validator;

class DatetimeForm extends Form
{

    public function __construct(array $data)
    {
        parent::__construct('unixtime-form');
        $this->setAttribute('method', 'get');
        $this->setElements();
        $this->setData($data);
    }

    public function setElements(): DatetimeForm
    {
        // for input unixtime.
        $this->add([
            'type' => 'text',
            'name' => 'q',
        ]);

        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name'     => 'q',
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
            ],
            'required' => false,
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => [
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        return $this;
    }
}
