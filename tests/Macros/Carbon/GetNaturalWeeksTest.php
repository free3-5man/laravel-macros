<?php

namespace Freeman\LaravelMacros\Test\Macros\Carbon;

use Carbon\Carbon;
use Freeman\LaravelMacros\Test\TestCase as TestCase;

class GetNaturalWeeksTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([
            ['2021-09-01', '2021-09-05'],
            ['2021-09-06', '2021-09-12'],
            ['2021-09-13', '2021-09-19'],
            ['2021-09-20', '2021-09-26'],
            ['2021-09-27', '2021-09-30'],
        ], (new Carbon('2021-09-06'))->getNaturalWeeks());

        $this->assertEquals([
            ['2021-08-01', '2021-08-01'],
            ['2021-08-02', '2021-08-08'],
            ['2021-08-09', '2021-08-15'],
            ['2021-08-16', '2021-08-22'],
            ['2021-08-23', '2021-08-29'],
            ['2021-08-30', '2021-08-31'],
        ], (new Carbon('2021-08'))->getNaturalWeeks());

        $this->assertEquals([
            ['2022-01-01', '2022-01-02'],
            ['2022-01-03', '2022-01-09'],
            ['2022-01-10', '2022-01-16'],
            ['2022-01-17', '2022-01-23'],
            ['2022-01-24', '2022-01-30'],
            ['2022-01-31', '2022-01-31'],
        ], (new Carbon('2022-01'))->getNaturalWeeks());
    }
}
