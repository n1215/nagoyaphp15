<?php

declare(strict_types=1);

namespace Nagoyaphp\Dokaku15;

class Dokaku15
{
    public function run(string $input): string
    {
        $lines = array_values(array_filter(range(0, 7), function (int $i) use ($input) {
            return str_split(sprintf('%b', $input))[$i] ?? false;
        }));

        $vertices = [];
        for ($i = 0; $i < count($lines); $i++) {
            $distance = ($lines[($i + 1) % count($lines)] - $lines[$i] + 8) % 8;
            $vertices[] = ($distance === 4 ? 2 : 3) + $distance - 1;
        }
        sort($vertices);

        return implode('', $vertices);
    }
}
