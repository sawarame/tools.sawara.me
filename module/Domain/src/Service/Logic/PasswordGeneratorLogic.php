<?php

namespace Domain\Service\Logic;

use Laminas\Stdlib\ArrayUtils;

class PasswordGeneratorLogic
{
    private $password;

    /**
     * Constructor.
     *
     * Set default timezone.
     */
    public function __construct(PasswordLogic $password)
    {
        $this->password = $password;
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
        $useChars = $this->password->filterUseCharacters(range('!', '~'), $exclude);
        return $this->password->generate($useChars, $length, $isAllowedSameChar);
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
        $useChars = $this->password->filterUseCharacters(ArrayUtils::merge($letters, $digits), $exclude);
        return $this->password->generate($useChars, $length, $isAllowedSameChar);
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
        $useChars = $this->password->filterUseCharacters($letters, $exclude);
        return $this->password->generate($useChars, $length, $isAllowedSameChar);
    }
}
