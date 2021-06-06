<?php

namespace Domain\Service\Logic;

use Laminas\Stdlib\ArrayUtils;

class PasswordLogic
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
            return array_values($useChars);
        }
        return array_values($chars);
    }

    /**
     * Generate password string.
     *
     * @param array $useChars
     * @param integer $length
     * @return string
     */
    public function generate(array $useChars, int $length, bool $isAllowedSameChar = false): string
    {
        if (! $isAllowedSameChar && count($useChars) < $length) {
            $isAllowedSameChar = true;
        }
        return substr(str_shuffle(str_repeat(implode('', $useChars), ($isAllowedSameChar ? $length : 1))), 0, $length);
    }
}
