<?php

declare(strict_types=1);

namespace DomainTest\Service\Logic;

use Laminas\Stdlib\ArrayUtils;
use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\PasswordLogic;
use Domain\Service\Logic\PasswordUtilLogic;

class PasswordLogicTest extends TestCase
{
    private $logic = null;
    private $util = null;

    public function setUp(): void
    {
        $this->util = $this->createMock(PasswordUtilLogic::class);
        $this->logic = new PasswordLogic($this->util);
    }

    public function testGenerateGraphPassword(): void
    {
        $letters = range('!', '~');
        $length = 10;
        $exclude = [];
        $isAllowedSameChar = false;

        $filterWillReturn = ['a', 'b', 'c'];
        $generateWillReturn = 'abcdefghij';

        $this->util->method('filterUseCharacters')->willReturn($filterWillReturn);
        $this->util->expects($this->once())
            ->method('filterUseCharacters')
            ->with(
                $this->equalTo($letters),
                $this->equalTo($exclude)
            );

        $this->util->method('generate')->willReturn($generateWillReturn);
        $this->util->expects($this->once())
            ->method('generate')
            ->with(
                $this->equalTo($filterWillReturn),
                $this->equalTo($length),
                $this->equalTo($isAllowedSameChar)
            );

        $this->assertEquals(
            $generateWillReturn,
            $this->logic->generateGraphPassword($length, $exclude, $isAllowedSameChar)
        );
    }

    public function testGenerateAlnumPassword(): void
    {
        $letters = ArrayUtils::merge(range('A', 'Z'), range('a', 'z'));
        $digits = range('0', '9');
        $letters = ArrayUtils::merge($letters, $digits);
        $length = 10;
        $exclude = [];
        $isAllowedSameChar = false;

        $filterWillReturn = ['a', 'b', 'c'];
        $generateWillReturn = 'abcdefghij';

        $this->util->method('filterUseCharacters')->willReturn($filterWillReturn);
        $this->util->expects($this->once())
            ->method('filterUseCharacters')
            ->with(
                $this->equalTo($letters),
                $this->equalTo($exclude)
            );

        $this->util->method('generate')->willReturn($generateWillReturn);
        $this->util->expects($this->once())
            ->method('generate')
            ->with(
                $this->equalTo($filterWillReturn),
                $this->equalTo($length),
                $this->equalTo($isAllowedSameChar)
            );

        $this->assertEquals(
            $generateWillReturn,
            $this->logic->generateAlnumPassword($length, $exclude, $isAllowedSameChar)
        );
    }

    public function testGenerateAlphaPassword(): void
    {
        $letters = ArrayUtils::merge(range('A', 'Z'), range('a', 'z'));
        $length = 10;
        $exclude = [];
        $isAllowedSameChar = false;

        $filterWillReturn = ['a', 'b', 'c'];
        $generateWillReturn = 'abcdefghij';

        $this->util->method('filterUseCharacters')->willReturn($filterWillReturn);
        $this->util->expects($this->once())
            ->method('filterUseCharacters')
            ->with(
                $this->equalTo($letters),
                $this->equalTo($exclude)
            );

        $this->util->method('generate')->willReturn($generateWillReturn);
        $this->util->expects($this->once())
            ->method('generate')
            ->with(
                $this->equalTo($filterWillReturn),
                $this->equalTo($length),
                $this->equalTo($isAllowedSameChar)
            );

        $this->assertEquals(
            $generateWillReturn,
            $this->logic->generateAlphaPassword($length, $exclude, $isAllowedSameChar)
        );
    }
}
