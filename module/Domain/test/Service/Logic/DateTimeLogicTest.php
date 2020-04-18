<?php

declare(strict_types=1);

namespace DomainTest\Service\Logic;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\DateTimeLogic;

class DateTimeLogicTest extends TestCase
{
    private $logic = null;

    public function setUp(): void
    {
        $this->logic = new DateTimeLogic();
    }

    public function testGenerateDateTime()
    {
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime());
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086'));
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086123'));
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime(microtime()));
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime('1585965086123456'));
        $this->assertInstanceOf(DateTimeImmutable::class, $this->logic->generateDateTime(' 2020-04-04T10:51:26'));
    }

    public function testGenerateDateTimeError()
    {
        $this->expectException(\Exception::class);
        $this->logic->generateDateTime('aaaa');
    }

    public function testIsUnixtime()
    {
        $this->assertTrue($this->logic->isUnixtime('1585965086'));
        $this->assertFalse($this->logic->isUnixtime('15859650861'));
        $this->assertFalse($this->logic->isUnixtime('aaa'));
    }

    public function testIsMillisecond()
    {
        $this->assertTrue($this->logic->isMillisecond('1585965086123'));
        $this->assertFalse($this->logic->isMillisecond('aaa'));
    }

    public function testIsMicrotime()
    {
        $this->assertTrue($this->logic->isMicrotime('0.14636600 1585965086'));
        $this->assertFalse($this->logic->isMicrotime('1585965086'));
        $this->assertFalse($this->logic->isMicrotime('aaa'));
    }

    public function testIsMicrosecond()
    {
        $this->assertTrue($this->logic->isMicrosecond('1585965086123456'));
        $this->assertFalse($this->logic->isMicrosecond('0.14636600 1585965086'));
        $this->assertFalse($this->logic->isMicrosecond('1585965086'));
        $this->assertFalse($this->logic->isMicrosecond('aaa'));
    }
}
