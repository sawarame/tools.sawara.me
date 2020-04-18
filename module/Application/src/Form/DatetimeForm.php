<?php

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Filter;
use Laminas\Validator;

class DateTimeForm extends Form
{
    public const TEXT_DATETIME_QUERY = 'q';

    public function __construct(array $data)
    {
        parent::__construct('date-form');
        $this->setAttribute('method', 'get');
        $this->setElements();
        $this->setData($data);
    }

    public function setElements(): DateTimeForm
    {
        // for input unixtime.
        $this->add([
            'type' => 'text',
            'name' => self::TEXT_DATETIME_QUERY,
        ]);

        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name'     => self::TEXT_DATETIME_QUERY,
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
