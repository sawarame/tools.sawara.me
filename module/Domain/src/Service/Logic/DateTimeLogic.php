<?php

namespace Domain\Service\Logic;

use DateTimeImmutable;
use DateTimeInterface;

class DateTimeLogic
{
    private const TIME_ZONE = 'Asia/Tokyo';

    private $dateTimeCheckLogic;

    /**
     * Constructor.
     *
     * Set default timezone.
     */
    public function __construct(DateTimeUtilLogic $dateTimeCheckLogic)
    {
        $this->dateTimeCheckLogic = $dateTimeCheckLogic;
        date_default_timezone_set(self::TIME_ZONE);
    }

    /**
     * Generate date time object from source string.
     *
     * @param string $source
     * @return DateTimeImmutable
     */
    public function generateDateTime(string $source = null): DateTimeImmutable
    {
        switch (true) {
            case is_null($source):
            case $source === "":
                return new DateTimeImmutable();
            case $this->dateTimeCheckLogic->isUnixtime($source):
                return new DateTimeImmutable(date(DateTimeInterface::ISO8601, $source));
            case $this->dateTimeCheckLogic->isMillisecond($source):
                return new DateTimeImmutable(date('Y-m-d H:i:s', substr($source, 0, 10))
                    . '.' . substr($source, 10, 3));
            case $this->dateTimeCheckLogic->isMicrotime($source):
                list($dec, $int) = preg_split('/\s/', $source);
                return new DateTimeImmutable(date('Y-m-d H:i:s', $int)
                    . '.' . substr($dec, 2, 6));
            case $this->dateTimeCheckLogic->isMicrosecond($source):
                return new DateTimeImmutable(date('Y-m-d H:i:s', substr($source, 0, 10))
                    . '.' . substr($source, 10, 6));
            default:
                $timestamp = strtotime($source);
                if (! $timestamp) {
                    throw new \Exception('failed to date conversion.');
                }
                // TODO: should catch exception.
                return new DateTimeImmutable(date(DateTimeInterface::ISO8601, $timestamp));
        }
    }
}
