<?php

namespace Freeman\LaravelMacros\Test;

use Carbon\Carbon;
use DateTime;
use Freeman\LaravelMacros\Test\TestCase;

class HelpersTest extends TestCase
{
    /** @test */
    public function testGetDateTimeString()
    {
        $this->assertEquals('2020-01-02 03:06:58', getDateTimeString(new DateTime('2020-01-02 03:06:58')));
        $this->assertEquals('2020-01-02 03:06:58', getDateTimeString(new Carbon('2020-01-02 03:06:58')));
        $this->assertEquals('2020-01-02 03:06:58', getDateTimeString('2020-01-02 03:06:58'));
        $this->assertEquals('2020-01-02', getDateTimeString('2020-01-02 03:06:58', 'Y-m-d'));

        $this->assertNull(getDateTimeString(123));
        $this->assertNull(getDateTimeString(null));

        // $this->expectExceptionMessageMatches('/^DateTime::__construct()/');
        // $this->assertNull(getDateTimeString('456'));
    }

    /** @test */
    public function testGetTimestamp()
    {
        $this->assertEquals(1577934418, getTimestamp(new DateTime('2020-01-02 03:06:58')));
        $this->assertEquals(1577934418, getTimestamp(new Carbon('2020-01-02 03:06:58')));
        $this->assertEquals(1577934418, getTimestamp('2020-01-02 03:06:58'));

        $this->assertNull(getTimestamp(123));
        $this->assertNull(getTimestamp(null));

        // $this->expectExceptionMessageMatches('/^DateTime::__construct()/');
        // $this->assertNull(getTimestamp('456'));
    }

    private function initAssoc()
    {
        return [
            'a' => new DateTime('2020-01-02 03:06:58'),
            'b' => new Carbon('2020-01-02 03:06:58'),
            'c' => '2020-01-02 03:06:58',
            'd' => null,
            'e' => [
                'f' => '2020-01',
                'g' => '2020-01-01',
            ],
            'h' => 'milan',
        ];
    }

    /** @test */
    public function testFormatDateTimeAssoc()
    {
        $assoc = $this->initAssoc();
        formatDateTimeAssoc($assoc, ['a', 'b', 'c', 'd', 'e.f', 'e.g'], 'Y-m-d H:i');
        $this->assertEquals([
            'a' => '2020-01-02 03:06',
            'b' => '2020-01-02 03:06',
            'c' => '2020-01-02 03:06',
            'd' => null,
            'e' => [
                'f' => '2020-01-01 00:00',
                'g' => '2020-01-01 00:00',
            ],
            'h' => 'milan',
        ], $assoc);

        $assoc = $this->initAssoc();
        formatDateTimeAssoc($assoc, ['a', 'b', 'c', 'd'], 'timestamp');
        $this->assertEquals([
            'a' => 1577934418,
            'b' => 1577934418,
            'c' => 1577934418,
            'd' => null,
            'e' => [
                'f' => '2020-01',
                'g' => '2020-01-01',
            ],
            'h' => 'milan',
        ], $assoc);
    }
}
