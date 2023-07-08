<?php

class Config
{
    public static function DB_HOST()
    {
        return Config::getEnv("DB_HOST", "localhost");
    }

    public static function DB_USERNAME()
    {
        return Config::getEnv("DB_USERNAME", "root");
    }

    public static function DB_PASSWORD()
    {
        return Config::getEnv("DB_PASSWORD", "root");
    }

    public static function DB_SCHEME()
    {
        return Config::getEnv("DB_SCHEME", "mydb");
    }

    public static function DB_PORT()
    {
        return Config::getEnv("DB_PORT", "3306");
    }

    public static function JWT_SECRET()
    {
        return Config::getEnv("JWT_SECRET", "JZ%@@qVNCmm2XB");
    }

    public static function getEnv($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}