<?php

declare(strict_types=1);

namespace App\Support;

class PageMeta
{
    private static string $title;

    private static string $description;

    private static array $props;

    private static array $meta;

    public static function setTitle(string $title): void
    {
        self::$title = $title;
    }

    public static function getTitle(): string
    {
        if (!isset(self::$title)) {
            return '';
        }

        return self::$title;
    }

    public static function setDescription(string $description): void
    {
        self::$description = $description;
    }

    public static function getDescription(): string
    {
        if (!isset(self::$description)) {
            return '';
        }

        return self::$description;
    }

    public static function setMeta(array $meta): void
    {
        self::$meta = $meta;
    }

    public static function getMeta(): array
    {
        if (!isset(self::$meta)) {
            return [];
        }

        return self::$meta;
    }

    public static function setProps(array $props): void
    {
        self::$props = $props;
    }

    public static function getProps(): array
    {
        if (!isset(self::$props)) {
            return [];
        }

        return self::$props;
    }
}
