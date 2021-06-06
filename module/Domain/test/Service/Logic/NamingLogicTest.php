<?php

declare(strict_types=1);

namespace DomainTest\Service\Logic;

use PHPUnit\Framework\TestCase;
use Domain\Service\Logic\NamingLogic;

class NamingLogicTest extends TestCase
{
    private $logic = null;

    public function setUp(): void
    {
        $this->logic = new NamingLogic();
    }

    /**
     *
     * @dataProvider providerConvertFromCamelCaseToSnakeCase
     */
    public function testConvertFromCamelCaseToSnakeCase(string $source, string $expected) : void
    {
        $actual = $this->logic->convertFromCamelCaseToSnakeCase($source);
        $this->assertEquals($expected, $actual);
    }

    public function providerConvertFromCamelCaseToSnakeCase()
    {
        return [
            'case 1' => ['test', 'test'],
            'case 2' => ['testCase2', 'test_case2'],
            'case 3' => ['testCase3Param', 'test_case3_param'],
            'case 4' => ['TestCase3', 'test_case3'],
        ];
    }

    /**
     *
     * @dataProvider providerConvertFromSnakeCaseToCamelCase
     */
    public function testConvertFromSnakeCaseToCamelCase(string $source, string $expected) : void
    {
        $actual = $this->logic->convertFromSnakeCaseToCamelCase($source);
        $this->assertEquals($expected, $actual);
    }

    public function providerConvertFromSnakeCaseToCamelCase()
    {
        return [
            'case 1' => ['test', 'test'],
            'case 2' => ['test_case2', 'testCase2'],
            'case 3' => ['test_case_3', 'testCase3'],
            'case 4' => ['test_case4_param', 'testCase4Param'],
        ];
    }
}
