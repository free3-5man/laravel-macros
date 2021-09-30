<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Returns the decapitalized string.
 *
 * @return string
 */
class Decapitalize
{
    public function __invoke()
    {
        return function (string $string, bool $allWords = false) {
            return preg_replace_callback('/(\w+)/', function ($matches) {
                return lcfirst($matches[1]);
            }, $string, $allWords ? -1 : 1);    // replace only first match when $allWords is false
        };
    }
}
