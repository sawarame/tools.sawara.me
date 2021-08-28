<?php

namespace Domain\Service\Logic;

use DateTimeImmutable;

class DateTimeDifferenceLogic
{

    /**
     * Constructor.
     *
     * Set default timezone.
     */
    public function __construct(DateTimeGeneratorLogic $dateTimeGenerator)
    {
        $this->dateTimeGenerator = $dateTimeGenerator;
    }

    public function calculate(string $since = null, string $until = null): array
    {
        $sinceDateTime = $this->dateTimeGenerator->generateDateTime($since);
        $untilDateTime = $this->dateTimeGenerator->generateDateTime($until);
        $seconds = abs($untilDateTime->getTimestamp() - $sinceDateTime->getTimestamp());
        return [
            "時刻1" => $this->dateTimeGenerator->generateDateStrings($sinceDateTime)['Y-m-d H:i:s'],
            "時刻2" => $this->dateTimeGenerator->generateDateStrings($untilDateTime)['Y-m-d H:i:s'],
            "秒" => $seconds,
            "分" => round($seconds / 60, 1),
            "時間" => round($seconds / 60 / 60, 1),
            "日数" => round($seconds / 60 / 60 / 24, 1),
        ];
    }
}
