<?php

namespace Domain\Service\Logic;

use DateTimeImmutable;
use DateTimeInterface;

class DateTimeLogic
{
    private const TIME_ZONE = 'Asia/Tokyo';

    /**
     * Constructor.
     *
     * Set default timezone.
     */
    public function __construct()
    {
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
            case $this->isUnixtime($source):
                return new DateTimeImmutable(date(DateTimeInterface::ISO8601, $source));
            case $this->isMillisecond($source):
                return new DateTimeImmutable(date('Y-m-d H:i:s', substr($source, 0, 10))
                    . '.' . substr($source, 10, 3));
            case $this->isMicrotime($source):
                list($dec, $int) = preg_split('/\s/', $source);
                return new DateTimeImmutable(date('Y-m-d H:i:s', $int)
                    . '.' . substr($dec, 2, 6));
            case $this->isMicrosecond($source):
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

    /**
     * Test whether a source is unixtime.
     *
     * @param string $source
     * @return boolean
     */
    public function isUnixtime(string $source): bool
    {
        if (preg_match('/^\d{10}$/u', $source)) {
            return true;
        }
        return false;
    }

    /**
     * Test whether a source is millisecond.
     *
     * @param mixed $source
     * @return bool
     */
    public function isMillisecond(string $source): bool
    {
        if (preg_match('/^\d{13}$/', $source)) {
            return true;
        }
        return false;
    }

    /**
     * Test whether a source is microtime.
     *
     * @param string $source
     * @return boolean
     */
    public function isMicrotime(string $source): bool
    {
        if (preg_match('/^0\.\d{6,8}\s\d{10}$/', $source)) {
            return true;
        }
        return false;
    }

    /**
     * Test whether a source is microsecond.
     *
     * @param string $source
     * @return boolean
     */
    public function isMicrosecond(string $source): bool
    {
        if (preg_match('/^\d{16}$/', $source)) {
            return true;
        }
        return false;
    }
}
