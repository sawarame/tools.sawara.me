<?php

namespace Domain\Service;

use DateTimeImmutable;
use DateTimeZone;
use DateTimeInterface;

class DateTimeService
{
    const TIME_ZONE = 'Asia/Tokyo';

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
     * Generate date string datas from source string.
     *
     * @param string $source source string.
     * @return array
     */
    public function generateDateStrings(string $source = null): array
    {
        $dateTime = $this->generateDateTime($source);
        return [
            'origin'     => $source,
            'Y年m月d日 H:i:s' => $dateTime->format('Y年m月d日 H:i:s'),
            'Y年m月d日 H:i:s.u' => $dateTime->format('Y年m月d日 H:i:s.u'),
            'Y-m-d H:i:s' => $dateTime->format('Y-m-d H:i:s'),
            'Y-m-d H:i:s.u' => $dateTime->format('Y-m-d H:i:s.u'),
            'Y/m/d H:i:s' => $dateTime->format('Y/m/d H:i:s'),
            'Y/m/d H:i:s.u' => $dateTime->format('Y/m/d H:i:s.u'),
            'unixtime'   => $dateTime->getTimestamp(),
            'millisecond'  => $dateTime->getTimestamp() . $dateTime->format('v'),
            'microsecond'  => $dateTime->getTimestamp() . $dateTime->format('u'),
            'ATOM' => $dateTime->format(DateTImeInterface::ATOM),
            'COOKIE' => $dateTime->format(DateTImeInterface::COOKIE),
            'ISO8601' => $dateTime->format(DateTImeInterface::ISO8601),
            'RFC822' => $dateTime->format(DateTImeInterface::RFC822),
            'RFC850' => $dateTime->format(DateTImeInterface::RFC850),
            'RFC1036' => $dateTime->format(DateTImeInterface::RFC1036),
            'RFC1123' => $dateTime->format(DateTImeInterface::RFC1123),
            'RFC7231' => $dateTime->format(DateTImeInterface::RFC7231),
            'RFC2822' => $dateTime->format(DateTImeInterface::RFC2822),
            'RFC3339' => $dateTime->format(DateTImeInterface::RFC3339),
            'RFC3339_EXTENDED' => $dateTime->format(DateTImeInterface::RFC3339_EXTENDED),
            'RSS' => $dateTime->format(DateTImeInterface::RSS),
            'W3C' => $dateTime->format(DateTImeInterface::W3C),
        ];
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
            case $this->isMicrosecond($source):
                list($dec, $int) = preg_split('/\s/', $source);
                return new DateTimeImmutable(date('Y-m-d H:i:s', $int)
                    . '.' . substr($dec, 2));
            default:
                // TODO: should catch exception. 
                return new DateTimeImmutable($source);
        }
    }

    /**
     * Check that source is unixtime or not.
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
     * Check that source is millisecond or not.
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
     * Check that source is microsecond or not.
     *
     * @param string $source
     * @return boolean
     */
    public function isMicrosecond(string $source): bool
    {
        if (preg_match('/^0\.\d{6,8}\s\d{10}$/', $source)) {
            return true;
        }
        return false;
    }
}
