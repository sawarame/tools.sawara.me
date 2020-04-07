<?php

namespace Domain\Service;

use DateTimeImmutable;
use DateTimeInterface;
use Laminas\Stdlib\ArrayUtils;

class StringService
{
    /**
     * Constructor.
     */
    public function __construct()
    {
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
        $useChars = array_filter(range('!', '~'), function ($var) use ($exclude) {
            return ! ArrayUtils::inArray($var, $exclude);
        });
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
        $useChars = array_filter(ArrayUtils::merge($letters, $digits), function ($var) use ($exclude) {
            return ! ArrayUtils::inArray($var, $exclude);
        });
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
        $useChars = array_filter($letters, function ($var) use ($exclude) {
            return ! ArrayUtils::inArray($var, $exclude);
        });
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
}
