<?php

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Filter;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator;

class DatetimeDifferenceForm extends Form implements InputFilterProviderInterface
{
    public const TEXT_DATETIME_SINCE = 'since';
    public const TEXT_DATETIME_UNTIL = 'until';

    private const ELEMENTS = [
        self::TEXT_DATETIME_SINCE => [
            'type' => 'text',
        ],
        self::TEXT_DATETIME_UNTIL => [
            'type' => 'text',
        ],
    ];

    private const INPUT_FILTERS = [
        self::TEXT_DATETIME_SINCE => [
            'required' => false,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
            ],
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => [
                        'max' => 100,
                    ],
                ],
            ],
        ],
        self::TEXT_DATETIME_UNTIL => [
            'required' => false,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
            ],
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => [
                        'max' => 100,
                    ],
                ],
            ],
        ],
    ];

    /**
     * Constructor.
     * set element and set data.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct();
        foreach (self::ELEMENTS as $key => $element) {
            $this->add(array_merge(['name' => $key], $element));
        }
        $this->setData($data);
    }

    public function getInputFilterSpecification()
    {
        return self::INPUT_FILTERS;
    }
}
