<?php

declare(strict_types=1);

namespace DomainTest\Service\Logic;

use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\PasswordLogic;

class PasswordLogicTest extends TestCase
{
    private $logic = null;

    public function setUp(): void
    {
        $this->logic = new PasswordLogic();
    }

    public function testFilterUseCharacters(): void
    {
        $chars = ['a', 'b', 'c', 'd', 'f', 'g'];
        $exclude = ['b', 'c', 'f'];
        $expect = ['a', 'd', 'g'];
        $this->assertEquals($expect, $this->logic->filterUseCharacters($chars, $exclude));
    }

    public function testGenerate(): void
    {
        $chars = ['a', 'b', 'c', 'd', 'f', 'g'];
        $this->assertSame(1, strlen($this->logic->generate($chars, 1)));
        $this->assertSame(10, strlen($this->logic->generate($chars, 10)));
        $this->assertSame(20, strlen($this->logic->generate($chars, 20)));
    }
}
