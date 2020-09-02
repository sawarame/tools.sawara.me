<?php

namespace Domain\Service\Logic;

use Laminas\Stdlib\ArrayUtils;

class PasswordUtilLogic
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
