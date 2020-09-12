<?php

declare(strict_types=1);

namespace DomainTest\Service\Logic;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\DateTimeLogic;
use Domain\Service\Logic\DateTimeUtilLogic;

class DateTimeLogicTest extends TestCase
{
    private $logic = null;
    private $util = null;

    public function setUp(): void
    {
        $this->util = $this->createMock(DateTimeUtilLogic::class);
        $this->logic = new DateTimeLogic($this->util);
    }

    public function testGenerateDateTime()
    {
        $this->util->method('isUnixtime')->willReturn(false);
        $this->util->method('isMillisecond')->willReturn(false);
        $this->util->method('isMicrotime')->willReturn(false);
        $this->util->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime());
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('2020-04-04T10:51:26'));
    }

    public function testGenerateDateTimeUnixTime()
    {
        $this->util->method('isUnixtime')->willReturn(true);
        $this->util->method('isMillisecond')->willReturn(false);
        $this->util->method('isMicrotime')->willReturn(false);
        $this->util->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086'));
    }

    public function testGenerateDateMillisecond()
    {
        $this->util->method('isUnixtime')->willReturn(false);
        $this->util->method('isMillisecond')->willReturn(true);
        $this->util->method('isMicrotime')->willReturn(false);
        $this->util->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086123'));
    }

    public function testGenerateDateMicrotime()
    {
        $this->util->method('isUnixtime')->willReturn(false);
        $this->util->method('isMillisecond')->willReturn(false);
        $this->util->method('isMicrotime')->willReturn(true);
        $this->util->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime(microtime()));
    }

    public function testGenerateDateMicrosecond()
    {
        $this->util->method('isUnixtime')->willReturn(false);
        $this->util->method('isMillisecond')->willReturn(false);
        $this->util->method('isMicrotime')->willReturn(false);
        $this->util->method('isMicrosecond')->willReturn(true);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086123456'));
    }

    public function testGenerateDateTimeError()
    {
        $this->util->method('isUnixtime')->willReturn(false);
        $this->util->method('isMillisecond')->willReturn(false);
        $this->util->method('isMicrotime')->willReturn(false);
        $this->util->method('isMicrosecond')->willReturn(false);
        $this->expectException(\Exception::class);
        $this->logic->generateDateTime('aaaa');
    }
}
