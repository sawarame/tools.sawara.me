<?php

namespace Domain\Service\Logic;

use Laminas\Stdlib\ArrayUtils;

class StringLogic
{
    /**
     * Filter characters.
     *
     * @param array $chars
     * @param array $exclude
     * @return void
     */
    public function filterUseCharacters(array $chars, array $exclude): array
    {
        $useChars = array_filter($chars, function ($var) use ($exclude) {
            return ! ArrayUtils::inArray($var, $exclude);
        });
        if ($useChars) {
            return $useChars;
        }
        return $chars;
    }

    /**
     * Generate password by ascii printing characters excluede spece.
     *
     * @param integer $length
     * @param array $exclude
     * @return void
     */
    public function generateGraphPassword(int $length, array $exclude = [], bool $isAllowedSameChar = false): string
    {
        $useChars = $this->filterUseCharacters(range('!', '~'), $exclude);
        return $this->generatePassword($useChars, $length, $isAllowedSameChar);
    }

    /**
     * Generate password by letters and digits.
     *
     * @param integer $length
     * @param array $exclude
     * @return void
     */
    public function generateAlnumPassword(int $length, array $exclude = [], bool $isAllowedSameChar = false): string
    {
        $letters = ArrayUtils::merge(range('A', 'Z'), range('a', 'z'));
        $digits = range('0', '9');
        $useChars = $this->filterUseCharacters(ArrayUtils::merge($letters, $digits), $exclude);
        return $this->generatePassword($useChars, $length, $isAllowedSameChar);
    }

    /**
     * Generate password by letters.
     *
     * @param integer $length
     * @param array $exclude
     * @return void
     */
    public function generateAlphaPassword(int $length, array $exclude = [], bool $isAllowedSameChar = false): string
    {
        $letters = ArrayUtils::merge(range('A', 'Z'), range('a', 'z'));
        $useChars = $this->filterUseCharacters($letters, $exclude);
        return $this->generatePassword($useChars, $length, $isAllowedSameChar);
    }

    /**
     * Generate password string.
     *
     * @param array $useChars
     * @param integer $length
     * @return string
     */
    public function generatePassword(array $useChars, int $length, bool $isAllowedSameChar = false): string
    {
        if (! $isAllowedSameChar && count($useChars) < $length) {
            $isAllowedSameChar = true;
        }
        return substr(str_shuffle(str_repeat(implode('', $useChars), ($isAllowedSameChar ? $length : 1))), 0, $length);
    }

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
