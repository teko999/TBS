<?php

class Lang
{
    protected static $data;

    public static function load($lang_code)
    {
        $langFilePath = ROOT . DS . 'lang' . DS . strtolower($lang_code) . '.php';

        self::$data = file_exists($langFilePath)
            ? include($langFilePath)
            : self::$data = include(Config::get('default_lang'));
    }

    public function get($key, $defaultValue)
    {
        return is(self::$data, strtolower($key), $defaultValue);
    }
}
