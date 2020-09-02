<?php

namespace Domain\Service\Logic;

use Laminas\Stdlib\ArrayUtils;

class StringLogic
{

    /**
     * Ailias convertFromCamelCaseToSnakeCase
     *
     * @param string $source
     * @return string
     */
    public function cc2sc(string $source): string
    {
        return $this->convertFromCamelCaseToSnakeCase($source);
    }

    /**
     * Ailias convertFromSnakeCaseToCamelCase
     *
     * @param string $source
     * @return string
     */
    public function sc2cc(string $source): string
    {
        return $this->convertFromSnakeCaseToCamelCase($source);
    }

    /**
     * Convert string from camel case to snake case.
     *
     * @param string $source
     * @return string
     */
    public function convertFromCamelCaseToSnakeCase(string $source): string
    {
        return preg_replace_callback('/([A-Z]+[^A-Z]*)/', function ($m) {
            return '_' . strtolower($m[1]);
        }, $source);
    }

    /**
     * Convert string from snake case to camel case.
     *
     * @return void
     */
    public function convertFromSnakeCaseToCamelCase(string $source): string
    {
        return preg_replace_callback('/(\_[a-z])/', function ($m) {
            return strtoupper(substr($m[1], 1));
        }, $source);
    }
}
