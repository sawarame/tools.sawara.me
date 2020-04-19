<?php

namespace Application\Filter;

use Laminas\Filter\AbstractFilter;

class Zen2Han extends AbstractFilter
{
    public function filter($value)
    {
        return mb_convert_kana($value, 'a');
    }
}
