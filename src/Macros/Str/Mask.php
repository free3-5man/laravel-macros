<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Replaces part of string with the specified mask character.
 *
 * @return string
 */
class Mask
{
    public function __invoke()
    {
        return function (string $string, int $offset, int $length, string $maskString = '*') {
            return substr($string, 0, $offset) . str_repeat($maskString, $length) . substr($string, $offset + $length);
        };
    }
}
