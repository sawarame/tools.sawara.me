<?php

declare(strict_types=1);

namespace DomainTest\Service\Logic;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\DateTimeGeneratorLogic;
use Domain\Service\Logic\DateTimeLogic;

class DateTimeGeneratorLogicTest extends TestCase
{
    private $logic = null;
    private $datetime = null;

    public function setUp(): void
    {
        $this->datetime = $this->createMock(DateTimeLogic::class);
        $this->logic = new DateTimeGeneratorLogic($this->datetime);
    }

    public function testGenerateDateTime()
    {
        $this->datetime->method('isUnixtime')->willReturn(false);
        $this->datetime->method('isMillisecond')->willReturn(false);
        $this->datetime->method('isMicrotime')->willReturn(false);
        $this->datetime->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime());
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('2020-04-04T10:51:26'));
    }

    public function testGenerateDateTimeUnixTime()
    {
        $this->datetime->method('isUnixtime')->willReturn(true);
        $this->datetime->method('isMillisecond')->willReturn(false);
        $this->datetime->method('isMicrotime')->willReturn(false);
        $this->datetime->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086'));
    }

    public function testGenerateDateMillisecond()
    {
        $this->datetime->method('isUnixtime')->willReturn(false);
        $this->datetime->method('isMillisecond')->willReturn(true);
        $this->datetime->method('isMicrotime')->willReturn(false);
        $this->datetime->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086123'));
    }

    public function testGenerateDateMicrotime()
    {
        $this->datetime->method('isUnixtime')->willReturn(false);
        $this->datetime->method('isMillisecond')->willReturn(false);
        $this->datetime->method('isMicrotime')->willReturn(true);
        $this->datetime->method('isMicrosecond')->willReturn(false);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime(microtime()));
    }

    public function testGenerateDateMicrosecond()
    {
        $this->datetime->method('isUnixtime')->willReturn(false);
        $this->datetime->method('isMillisecond')->willReturn(false);
        $this->datetime->method('isMicrotime')->willReturn(false);
        $this->datetime->method('isMicrosecond')->willReturn(true);
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086123456'));
    }

    public function testGenerateDateTimeError()
    {
        $this->datetime->method('isUnixtime')->willReturn(false);
        $this->datetime->method('isMillisecond')->willReturn(false);
        $this->datetime->method('isMicrotime')->willReturn(false);
        $this->datetime->method('isMicrosecond')->willReturn(false);
        $this->expectException(\Exception::class);
        $this->logic->generateDateTime('aaaa');
    }
}
