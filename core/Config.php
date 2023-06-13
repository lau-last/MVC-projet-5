<?php

namespace Core;

class Config
{
    private array $settings = [];
    private static ?Config $_instance = null;

    private function __construct(string $file)
    {
        $this->settings = require($file);
    }

    public static function init(string $file): Config
    {
        if (\is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    public function get(string $key): ?string
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }

}