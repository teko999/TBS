<?php

class Config
{
    protected static $settings = [];

    public static function get($key)
    {
        return is(self::$settings, $key);
    }

    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}
