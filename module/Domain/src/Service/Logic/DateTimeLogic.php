<?php

namespace Domain\Service\Logic;

use DateTimeImmutable;
use DateTimeInterface;

class DateTimeLogic
{
    private const TIME_ZONE = 'Asia/Tokyo';

    private $util;

    /**
     * Constructor.
     *
     * Set default timezone.
     */
    public function __construct(DateTimeUtilLogic $util)
    {
        $this->util = $util;
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
            case $this->util->isUnixtime($source):
                return new DateTimeImmutable(date(DateTimeInterface::ISO8601, $source));
            case $this->util->isMillisecond($source):
                return new DateTimeImmutable(date('Y-m-d H:i:s', substr($source, 0, 10))
                    . '.' . substr($source, 10, 3));
            case $this->util->isMicrotime($source):
                list($dec, $int) = preg_split('/\s/', $source);
                return new DateTimeImmutable(date('Y-m-d H:i:s', $int)
                    . '.' . substr($dec, 2, 6));
            case $this->util->isMicrosecond($source):
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
     * Generate various date strings.
     *
     * @param DateTimeImmutable $dateTime
     * @return array
     */
    public function generateDateStrings(DateTimeImmutable $dateTime): array
    {
        return [
            'Y-m-d H:i:s'       => $dateTime->format('Y-m-d H:i:s'),
            'Y-m-d H:i:s.u'     => $dateTime->format('Y-m-d H:i:s.u'),
            'Y/m/d H:i:s'       => $dateTime->format('Y/m/d H:i:s'),
            'Y/m/d H:i:s.u'     => $dateTime->format('Y/m/d H:i:s.u'),
            'Y年m月d日 H:i:s'   => $dateTime->format('Y年m月d日 H:i:s'),
            'Y年m月d日 H:i:s.u' => $dateTime->format('Y年m月d日 H:i:s.u'),
            'YmdHis'            => $dateTime->format('YmdHis'),
            'unixtime'          => $dateTime->getTimestamp(),
            'millisecond'       => $dateTime->getTimestamp() . $dateTime->format('v'),
            'microsecond'       => $dateTime->getTimestamp() . $dateTime->format('u'),
            'ATOM'              => $dateTime->format(DateTimeInterface::ATOM),
            'COOKIE'            => $dateTime->format(DateTimeInterface::COOKIE),
            'ISO8601'           => $dateTime->format(DateTimeInterface::ISO8601),
            'RFC822'            => $dateTime->format(DateTimeInterface::RFC822),
            'RFC850'            => $dateTime->format(DateTimeInterface::RFC850),
            'RFC1036'           => $dateTime->format(DateTimeInterface::RFC1036),
            'RFC1123'           => $dateTime->format(DateTimeInterface::RFC1123),
            'RFC7231'           => $dateTime->format(DateTimeInterface::RFC7231),
            'RFC2822'           => $dateTime->format(DateTimeInterface::RFC2822),
            'RFC3339'           => $dateTime->format(DateTimeInterface::RFC3339),
            'RFC3339_EXTENDED'  => $dateTime->format(DateTimeInterface::RFC3339_EXTENDED),
            'RSS'               => $dateTime->format(DateTimeInterface::RSS),
            'W3C'               => $dateTime->format(DateTimeInterface::W3C),
        ];
    }
}
