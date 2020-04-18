<?php

declare(strict_types=1);

namespace DomainTest\Service\Test;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\StringLogic;

class StringLogicTest extends TestCase
{
    private $logic = null;

    public function setUp(): void
    {
        $this->logic = new StringLogic();
    }

    public function testGenerateGraphPassword()
    {
        $length = 12;
        $result = $this->logic->generateGraphPassword($length);
        $this->assertRegExp('/^[!-~]{' . $length . '}$/', $result);

        $result = $this->logic->generateGraphPassword($length, ['0', '1', '2']);
        $this->assertRegExp('/^[^012]{' . $length . '}$/', $result);
    }

    public function testGenerateAlnumPassword()
    {
        $length = 12;
        $result = $this->logic->generateAlnumPassword($length);
        $this->assertRegExp('/^[0-9A-Za-z]{' . $length . '}$/', $result);

        $result = $this->logic->generateAlnumPassword($length, ['0', '1', '2']);
        $this->assertRegExp('/^[^012]{' . $length . '}$/', $result);
    }

    public function testGenerateAlphaPassword()
    {
        $length = 12;
        $result = $this->logic->generateAlphaPassword($length);
        $this->assertRegExp('/^[A-Za-z]{' . $length . '}$/', $result);

        $result = $this->logic->generateAlnumPassword($length, ['a', 'b', 'c']);
        $this->assertRegExp('/^[^abc]{' . $length . '}$/', $result);
    }

    public function testGeneratePassword()
    {
        $useChars = range('!', '~');
        $length = 12;
        $result = $this->logic->generatePassword($useChars, $length);
        $this->assertRegExp('/^[!-~]{' . $length . '}$/', $result);
    }
}
