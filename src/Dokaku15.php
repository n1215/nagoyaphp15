<?php

declare(strict_types=1);

namespace Nagoyaphp\Dokaku15;

class Dokaku15
{
    public function run(string $input): string
    {
        $factors = $this->factorize(intval($input));

        $vertices = [];
        for ($i = 0; $i < count($factors); $i++) {
            $vertices[] = $this->getVertices($factors[$i], $factors[($i + 1) % count($factors)]);
        }
        sort($vertices);

        return implode('', $vertices);
    }

    private function factorize(int $input): array
    {
        $factors = [];

        for ($rest = $input, $i = 128; floor($i) > 0; $i = $i / 2) {
            if ($rest >= $i) {
                $factors[] = $i;
                $rest -= $i;
            }
        }

        sort($factors);

        return $factors;
    }

    private function getVertices(int $factor1, int $factor2): int
    {
        $small = min($factor1, $factor2);
        $big = max($factor1, $factor2);

        $distance = 0;

        for ($i = $big; $i > $small; $i = $i / 2) {
            $distance++;
        }

        $factor1 < $factor2 || $distance = 8 - $distance;

        return ($distance === 4 ? 2 : 3) + $distance - 1;
    }
}
