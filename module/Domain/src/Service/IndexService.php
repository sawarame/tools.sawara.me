<?php

namespace Domain\Service;

use DateTimeImmutable;
use DateTimeInterface;

class IndexService
{
    private $dateTimeLogic;
    private $stringLogic;

    /** Constructor. */
    public function __construct(
        Logic\DateTimeLogic $dateTimeLogic,
        Logic\StringLogic $stringLogic
    ) {
        $this->dateTimeLogic = $dateTimeLogic;
        $this->stringLogic = $stringLogic;
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
        return [
            'Original string'   => $source,
            'Y年m月d日 H:i:s'   => $dateTime->format('Y年m月d日 H:i:s'),
            'Y年m月d日 H:i:s.u' => $dateTime->format('Y年m月d日 H:i:s.u'),
            'Y-m-d H:i:s'       => $dateTime->format('Y-m-d H:i:s'),
            'Y-m-d H:i:s.u'     => $dateTime->format('Y-m-d H:i:s.u'),
            'Y/m/d H:i:s'       => $dateTime->format('Y/m/d H:i:s'),
            'Y/m/d H:i:s.u'     => $dateTime->format('Y/m/d H:i:s.u'),
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
            $graph[] = $this->stringLogic->generateGraphPassword($length, $exclude, $isAllowedSameChar);
            $alnum[] = $this->stringLogic->generateAlnumPassword($length, $exclude, $isAllowedSameChar);
            $alpha[] = $this->stringLogic->generateAlphaPassword($length, $exclude, $isAllowedSameChar);
        }

        return [
            'graph' => $graph,
            'alnum' => $alnum,
            'alpha' => $alpha,
        ];
    }
}
