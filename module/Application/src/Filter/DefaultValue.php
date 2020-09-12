<?php

namespace Application\Filter;

use Laminas\Filter\AbstractFilter;

class DefaultValue extends AbstractFilter
{
    private $defaultValue = '';

    protected $options = [
        'default' => '',
    ];

    public function __construct($options = null)
    {
        if (! isset($options['default'])) {
            $args = func_get_args();
            if (isset($args[0])) {
                $this->defaultValue = $args[0];
            }
        } else {
            $this->defaultValue = $options['default'];
        }
    }

    public function filter($value)
    {
        if (empty($value)) {
            return $this->defaultValue;
        }
        return $value;
    }
}
