<?php

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Filter;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator;
use Application\Filter as ApplicationFilter;

class PasswordForm extends Form implements InputFilterProviderInterface
{
    public const TEXT_NUMBER_OF_CHARACTERS = 'noc';
    public const TEXT_NUMBER_OF_PASSWORDS = 'nop';
    public const TEXT_EXCLUDE_CHARACTERS = 'exc';
    public const CHECKBOX_IS_DISALLOW_SAME_CHARACTER = 'dsc';

    private const ELEMENTS = [
        self::TEXT_NUMBER_OF_CHARACTERS => [
            'type' => 'text',
        ],
        self::TEXT_NUMBER_OF_PASSWORDS => [
            'type' => 'text',
        ],
        self::TEXT_EXCLUDE_CHARACTERS => [
            'type' => 'text',
        ],
        self::CHECKBOX_IS_DISALLOW_SAME_CHARACTER => [
            'type' => 'checkbox',
        ],
    ];

    private const INPUT_FILTERS = [
        self::TEXT_NUMBER_OF_CHARACTERS => [
            'required' => false,
            'filters'  => [
                [
                    'name' => ApplicationFilter\Zen2Han::class
                ],
                [
                    'name' => Filter\ToInt::class
                ],
                [
                    'name' => ApplicationFilter\DefaultValue::class,
                    'options' => [
                        'default' => 16,
                    ],
                ],
            ],
            'validators' => [
                [
                    'name' => Validator\Digits::class,
                ],
                [
                    'name'    => Validator\Between::class,
                    'options' => [
                        'min' => 6,
                        'max' => 50,
                    ],
                ],
            ],
        ],
        self::TEXT_NUMBER_OF_PASSWORDS => [
            'required' => false,
            'filters'  => [
                [
                    'name' => ApplicationFilter\Zen2Han::class
                ],
                [
                    'name' => Filter\ToInt::class
                ],
                [
                    'name' => ApplicationFilter\DefaultValue::class,
                    'options' => [
                        'default' => 3,
                    ],
                ],
            ],
            'validators' => [
                [
                    'name'    => Validator\Digits::class,
                ],
                [
                    'name'    => Validator\Between::class,
                    'options' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ],
        self::TEXT_EXCLUDE_CHARACTERS => [
            'required' => false,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
                [
                    'name' => ApplicationFilter\DefaultValue::class,
                    'options' => [
                        'default' => '',
                    ],
                ],
            ],
        ],
        self::CHECKBOX_IS_DISALLOW_SAME_CHARACTER => [
            'required' => false,
            'filters'  => [
                [
                    'name' => ApplicationFilter\DefaultValue::class,
                    'options' => [
                        'default' => 1,
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
        parent::__construct('password-form');
        $this->setAttribute('method', 'get');
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
