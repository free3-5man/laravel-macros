<?php

namespace Freeman\LaravelMacros\Test\Macros\Builder;

use Carbon\CarbonPeriod;
use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\Film;

class OverlapsTest extends TestCase
{
    /** @test */
    public function test()
    {
        $builder = Film::query();

        $this->assertEquals(0, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 18:00:00', '2020-12-31 19:00:00'))->count());

        $this->assertEquals(1, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 19:00:00', '2020-12-31 19:00:01'))->count());
        $this->assertEquals(1, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 21:29:59', '2020-12-31 21:30:00'))->count());

        $this->assertEquals(2, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 21:30:00', '2020-12-31 21:30:01'))->count());

        $this->assertEquals(1, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2021-01-01 00:29:59', '2021-01-01 00:30:00'))->count());
        $this->assertEquals(0, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2021-01-01 00:30:00', '2021-01-01 00:30:01'))->count());

        $this->assertEquals(3, (clone $builder)->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 21:59:59', '2021-01-01 01:00:01'))->count());
    }
}
