<?php

declare(strict_types=1);

namespace DomainTest\Controller;

use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Domain\Service\StringService;

class StringServiceTest extends TestCase
{
    private $service = null;

    public function setUp(): void
    {
        $this->service = new StringService();
    }

    public function testGenerateGraphPassword()
    {
        $length = 12;
        $result = $this->service->generateGraphPassword($length);
        $this->assertRegExp('/^[!-~]{' . $length . '}$/', $result);

        $result = $this->service->generateGraphPassword($length, ['0', '1', '2']);
        $this->assertRegExp('/^[^012]{' . $length . '}$/', $result);
    }

    public function testGenerateAlnumPassword()
    {
        $length = 12;
        $result = $this->service->generateAlnumPassword($length);
        $this->assertRegExp('/^[0-9A-Za-z]{' . $length . '}$/', $result);

        $result = $this->service->generateAlnumPassword($length, ['0', '1', '2']);
        $this->assertRegExp('/^[^012]{' . $length . '}$/', $result);
    }

    public function testGenerateAlphaPassword()
    {
        $length = 12;
        $result = $this->service->generateAlphaPassword($length);
        $this->assertRegExp('/^[A-Za-z]{' . $length . '}$/', $result);

        $result = $this->service->generateAlnumPassword($length, ['a', 'b', 'c']);
        $this->assertRegExp('/^[^abc]{' . $length . '}$/', $result);
    }

    public function testGeneratePassword()
    {
        $useChars = range('!', '~');
        $length = 12;
        $result = $this->service->generatePassword($useChars, $length);
        $this->assertRegExp('/^[!-~]{' . $length . '}$/', $result);
    }
}
