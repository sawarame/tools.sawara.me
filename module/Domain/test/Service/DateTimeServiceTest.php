<?php

declare(strict_types=1);

namespace DomainTest\Controller;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Domain\Service\DateTimeService;

class DateTimeServiceTest extends TestCase
{
    private $service = null;

    public function setUp(): void
    {
        $this->service =  new DateTimeService();
    }

    public function testGenerateDateStrings()
    {
        $source = '1585965086';
        $expect = [
            'Original string'   => '1585965086',
            'Y年m月d日 H:i:s'   => '2020年04月04日 10:51:26',
            'Y年m月d日 H:i:s.u' => '2020年04月04日 10:51:26.000000',
            'Y-m-d H:i:s'       => '2020-04-04 10:51:26',
            'Y-m-d H:i:s.u'     => '2020-04-04 10:51:26.000000',
            'Y/m/d H:i:s'       => '2020/04/04 10:51:26',
            'Y/m/d H:i:s.u'     => '2020/04/04 10:51:26.000000',
            'unixtime'          => 1585965086,
            'millisecond'       => '1585965086000',
            'microsecond'       => '1585965086000000',
            'ATOM'              => '2020-04-04T10:51:26+09:00',
            'COOKIE'            => 'Saturday, 04-Apr-2020 10:51:26 GMT+0900',
            'ISO8601'           => '2020-04-04T10:51:26+0900',
            'RFC822'            => 'Sat, 04 Apr 20 10:51:26 +0900',
            'RFC850'            => 'Saturday, 04-Apr-20 10:51:26 GMT+0900',
            'RFC1036'           => 'Sat, 04 Apr 20 10:51:26 +0900',
            'RFC1123'           => 'Sat, 04 Apr 2020 10:51:26 +0900',
            'RFC7231'           => 'Sat, 04 Apr 2020 10:51:26 GMT',
            'RFC2822'           => 'Sat, 04 Apr 2020 10:51:26 +0900',
            'RFC3339'           => '2020-04-04T10:51:26+09:00',
            'RFC3339_EXTENDED'  => '2020-04-04T10:51:26.000+09:00',
            'RSS'               => 'Sat, 04 Apr 2020 10:51:26 +0900',
            'W3C'               => '2020-04-04T10:51:26+09:00',
        ];
        
        $this->assertSame($expect, $this->service->generateDateStrings($source));
    }

    public function testGenerateDateStringsError()
    {
        $this->expectException(\Exception::class);
        $this->service->generateDateStrings('aaaa');
    }

    public function testGenerateDateTime()
    {
        $this->assertInstanceOf(DateTimeImmutable::class,  $this->service->generateDateTime());
        $this->assertInstanceOf(DateTimeImmutable::class,  $this->service->generateDateTime('1585965086'));
        $this->assertInstanceOf(DateTimeImmutable::class,  $this->service->generateDateTime('1585965086123'));
        $this->assertInstanceOf(DateTimeImmutable::class,  $this->service->generateDateTime(microtime()));
        $this->assertInstanceOf(DateTimeImmutable::class,  $this->service->generateDateTime('1585965086123456'));
        $this->assertInstanceOf(DateTimeImmutable::class,  $this->service->generateDateTime(' 2020-04-04T10:51:26'));
    }

    public function testGenerateDateTimeError()
    {
        $this->expectException(\Exception::class);
        $this->service->generateDateTime('aaaa');
    }

    public function testIsUnixtime()
    {
        $this->assertTrue($this->service->isUnixtime('1585965086'));
        $this->assertFalse($this->service->isUnixtime('15859650861'));
        $this->assertFalse($this->service->isUnixtime('aaa'));
    }

    public function testIsMillisecond()
    {
        $this->assertTrue($this->service->isMillisecond('1585965086123'));
        $this->assertFalse($this->service->isMillisecond('aaa'));
    }

    public function testIsMicrotime()
    {
        $this->assertTrue($this->service->isMicrotime('0.14636600 1585965086'));
        $this->assertFalse($this->service->isMicrotime('1585965086'));
        $this->assertFalse($this->service->isMicrotime('aaa'));
    }

    public function testIsMicrosecond()
    {
        $this->assertTrue($this->service->isMicrosecond('1585965086123456'));
        $this->assertFalse($this->service->isMicrosecond('0.14636600 1585965086'));
        $this->assertFalse($this->service->isMicrosecond('1585965086'));
        $this->assertFalse($this->service->isMicrosecond('aaa'));
    }
}