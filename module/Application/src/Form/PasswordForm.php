<?php

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Filter;
use Laminas\Validator;
use Application\Filter\DefaultFilter;

class PasswordForm extends Form
{
    public const TEXT_NUMBER_OF_CHARACTERS = 'noc';
    public const TEXT_NUMBER_OF_PASSWORDS = 'nop';
    public const TEXT_EXCLUDE_CHARACTERS = 'exc';
    public const CHECKBOX_IS_DISALLOW_SAME_CHARACTER = 'dsc';

    public function __construct(array $data)
    {
        parent::__construct('password-form');
        $this->setAttribute('method', 'get');
        $this->setElements();
        $this->setData($data);
    }

    public function setElements(): PasswordForm
    {
        $this->add([
            'type' => 'text',
            'name' => self::TEXT_NUMBER_OF_CHARACTERS,
        ]);
        $this->add([
            'type' => 'text',
            'name' => self::TEXT_NUMBER_OF_PASSWORDS,
        ]);
        $this->add([
            'type' => 'text',
            'name' => self::TEXT_EXCLUDE_CHARACTERS,
        ]);
        $this->add([
            'type' => 'checkbox',
            'name' => self::CHECKBOX_IS_DISALLOW_SAME_CHARACTER,
        ]);

        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name'     => self::TEXT_NUMBER_OF_CHARACTERS,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
                [
                    'name' => DefaultFilter::class,
                    'options' => [
                        'default' => 16,
                    ],
                ],
            ],
            'required' => false,
            'validators' => [
                [
                    'name'    => Validator\Digits::class,
                ],
                [
                    'name'    => Validator\Between::class,
                    'options' => [
                        'min' => 6,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => self::TEXT_NUMBER_OF_PASSWORDS,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
                [
                    'name' => DefaultFilter::class,
                    'options' => [
                        'default' => 3,
                    ],
                ],
            ],
            'required' => false,
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
        ]);

        $inputFilter->add([
            'name'     => self::TEXT_EXCLUDE_CHARACTERS,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
                [
                    'name' => DefaultFilter::class,
                    'options' => [
                        'default' => '',
                    ],
                ],
            ],
            'required' => false,
        ]);

        $inputFilter->add([
            'name'     => self::CHECKBOX_IS_DISALLOW_SAME_CHARACTER,
            'filters'  => [
                [
                    'name' => Filter\StringTrim::class
                ],
                [
                    'name' => DefaultFilter::class,
                    'options' => [
                        'default' => 1,
                    ],
                ],
            ],
            'required' => false,
        ]);

        return $this;
    }
}
