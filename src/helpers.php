<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;

if (!function_exists('getDateTimeString')) {
    function getDateTimeString($dt, $format = 'Y-m-d H:i:s')
    {
        if ($dt instanceof Carbon)
            return $dt->format($format);
        if ($dt instanceof DateTime)
            return $dt->format($format);
        if (is_string($dt))
            return (new Carbon($dt))->format($format);

        return null;
    }
}

if (!function_exists('getTimestamp')) {
    function getTimestamp($dt)
    {
        if ($dt instanceof Carbon)
            return $dt->timestamp;
        if ($dt instanceof DateTime)
            return $dt->getTimestamp();
        if (is_string($dt))
            return (new Carbon($dt))->timestamp;

        return null;
    }
}

if (!function_exists('formatDateTimeAssoc')) {
    function formatDateTimeAssoc(array &$assoc, $keys, string $format = 'Y-m-d H:i:s')
    {
        $keys = Arr::wrap($keys);

        foreach ($keys as $key) {
            $val = data_get($assoc, $key);
            if (empty($val))
                continue;

            data_set($assoc, $key, $format === 'timestamp' ? getTimestamp($val) : getDateTimeString($val, $format));
        }
    }
}
