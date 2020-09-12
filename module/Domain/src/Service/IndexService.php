<?php

namespace Domain\Service;

class IndexService
{
    private $dateTimeLogic;
    private $passwordLogic;

    /** Constructor. */
    public function __construct(
        Logic\DateTimeLogic $dateTimeLogic,
        Logic\PasswordLogic $passwordLogic
    ) {
        $this->dateTimeLogic = $dateTimeLogic;
        $this->passwordLogic = $passwordLogic;
    }

    /**
     * Generate date string datas from source string.
     *
     * @param string $source source string.
     * @return array
     */
    public function generateDateStrings(string $source = null): array
    {
        $dateTime = $this->dateTimeLogic->generateDateTime($source);
        return $this->dateTimeLogic->generateDateStrings($dateTime);
    }

    /**
     * Genarate some passwords
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
            $graph[] = $this->passwordLogic->generateGraphPassword($length, $exclude, $isAllowedSameChar);
            $alnum[] = $this->passwordLogic->generateAlnumPassword($length, $exclude, $isAllowedSameChar);
            $alpha[] = $this->passwordLogic->generateAlphaPassword($length, $exclude, $isAllowedSameChar);
        }

        return [
            'graph' => $graph,
            'alnum' => $alnum,
            'alpha' => $alpha,
        ];
    }
}
