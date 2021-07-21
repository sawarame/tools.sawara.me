<?php

namespace Domain\Service;

class IndexControllerService
{
    private $dateTimeGenerator;
    private $passwordGenerator;

    /**
     * Constructor.
     */
    public function __construct(
        Logic\DateTimeGeneratorLogic $dateTimeGenerator,
        Logic\PasswordGeneratorLogic $passwordGenerator
    ) {
        $this->dateTimeGenerator = $dateTimeGenerator;
        $this->passwordGenerator = $passwordGenerator;
    }

    /**
     * Generate date string data from source string.
     *
     * @param string $source source string.
     * @return array
     */
    public function generateDateStrings(string $source = null): array
    {
        $dateTime = $this->dateTimeGenerator->generateDateTime($source);
        return $this->dateTimeGenerator->generateDateStrings($dateTime);
    }

    /**
     * Generate passwords.
     *
     * @return void
     */
    public function generatePasswords(
        int $number,
        int $length,
        array $exclude = [],
        bool $isAllowedSameChar = false
    ) {
        $graph = [];
        $alnum = [];
        $alpha = [];
        for ($i = 0; $i < $number; $i++) {
            $graph[] = $this->passwordGenerator->generateGraphPassword($length, $exclude, $isAllowedSameChar);
            $alnum[] = $this->passwordGenerator->generateAlnumPassword($length, $exclude, $isAllowedSameChar);
            $alpha[] = $this->passwordGenerator->generateAlphaPassword($length, $exclude, $isAllowedSameChar);
        }

        return [
            'graph' => $graph,
            'alnum' => $alnum,
            'alpha' => $alpha,
        ];
    }
}
