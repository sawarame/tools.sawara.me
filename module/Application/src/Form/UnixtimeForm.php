<?php

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Filter;
use Laminas\Validator;

class UnixtimeForm extends Form {

   public function __construct(array $data)
   {
       parent::__construct('unixtime-form');
       $this->setAttribute('method', 'get');
       $this->setElements();
       $this->setData($data);
   }

   public function setElements() : UnixtimeForm
   {
        // for input unixtime.
        $this->add([
            'type' => 'text',
            'name' => 'query',
            'options' => [
                'label' => 'unixtime',
            ],
        ]);

        // submit button.
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'submit',
                'id' => 'submit',
            ],
        ]);

        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name'     => 'query',
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