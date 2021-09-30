<?php

namespace Freeman\LaravelMacros\Test;

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use Freeman\LaravelMacros\MacroServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        $this->createDummyprovider()->register();
    }

    protected function createDummyprovider(): MacroServiceProvider
    {
        $reflectionClass = new ReflectionClass(MacroServiceProvider::class);

        return $reflectionClass->newInstanceWithoutConstructor();
    }
}
