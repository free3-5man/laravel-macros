<?php

namespace Freeman\LaravelMacros\Test\Macros\CarbonPeriod;

use Carbon\CarbonPeriod;
use Freeman\LaravelMacros\Test\TestCase as TestCase;

class CountWeeksTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(1, (new CarbonPeriod('2021-07-31', '2021-08-01'))->countWeeks());
        $this->assertEquals(1, (new CarbonPeriod('2021-08-01', '2021-08-01'))->countWeeks());
        $this->assertEquals(2, (new CarbonPeriod('2021-08-01', '2021-08-02'))->countWeeks());
        $this->assertEquals(2, (new CarbonPeriod('2021-08-02', '2021-08-01'))->countWeeks());
        $this->assertEquals(6, (new CarbonPeriod('2021-08-01', '2021-08-31'))->countWeeks());
        $this->assertEquals(5, (new CarbonPeriod('2021-09-01', '2021-09-30'))->countWeeks());
        $this->assertEquals(1, (new CarbonPeriod('2021-12-31', '2022-01-01'))->countWeeks());
        $this->assertEquals(2, (new CarbonPeriod('2021-12-31', '2022-01-03'))->countWeeks());
    }
}
