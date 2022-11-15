<?php

declare(strict_types=1);

namespace Tests\Unit\Support;

use App\Support\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function testEvery()
    {
        $haystack = [1, 2, 3, 4];
        $callback = function ($item) {
            return $item > 0;
        };
        self::assertTrue(Arr::every($haystack, $callback));
    }

    public function testEveryWithoutCallback()
    {
        $haystack = [1, 2, 3, 4];
        self::assertTrue(Arr::every($haystack, null));
    }

    public function testNotEvery()
    {
        $haystack = [0, 1, 2, 3, 4];
        $callback = function ($item) {
            return $item > 0;
        };
        self::assertFalse(Arr::every($haystack, $callback));
    }

    public function testFind()
    {
        $haystack = [1, 2, 3, 4];
        $callback = function ($item) {
            return $item == 1;
        };
        $element = Arr::find($haystack, $callback);
        self::assertEquals(1, $element);
    }

    public function testNotFound()
    {
        $haystack = [2, 3, 4];
        $callback = function ($item) {
            return $item == 1;
        };
        self::assertNull(Arr::find($haystack, $callback));
    }

    public function testExists()
    {
        $haystack = [1, 2, 3, 4];
        $callback = function ($item) {
            return $item == 1;
        };
        self::assertTrue(Arr::exists($haystack, $callback));
    }

    public function testNotExists()
    {
        $haystack = [2, 3, 4];
        $callback = function ($item) {
            return $item == 1;
        };
        self::assertFalse(Arr::exists($haystack, $callback));
    }
}
