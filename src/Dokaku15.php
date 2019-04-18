<?php

declare(strict_types=1);

namespace Nagoyaphp\Dokaku15;

class Dokaku15
{
    public function run(string $input): string
    {
        $binInput = sprintf('%08d', decbin((int) $input));
        $normalizedBinInput = $this->normalize($binInput);
        $codes = $this->splitIntoCodes($normalizedBinInput);
        $polygons = array_map([$this, 'codeToPolygon'], $codes);
        return $this->format($polygons);
    }

    /**
     * 出力を変えずに入力を正規化する
     * 図形的には回転して1の位置に線分がある状態にしている
     *   ex. '11010110' -> '01101011'
     * @param string $binInput
     * @return string
     */
    private function normalize(string $binInput): string
    {
        preg_match('/^(.*1)(0*)$/', $binInput, $match);
        return ($match[2] ?? '') . $match[1] ?? '';
    }

    /**
     * 入力を多角形に対応するコードに分解
     *   ex. '01010011' -> ['01', '01', '001', '1']
     * @param string $binInput
     * @return string[]
     */
    private function splitIntoCodes(string $binInput): array
    {
        preg_match_all('/0*1/', $binInput, $matches);
        return $matches[0];
    }

    /**
     * コードを多角形の頂点の数に変換
     *   ex.
     *   '1'       -> 3
     *   '01'      -> 4
     *   '001'     -> 5
     *   '0001'    -> 5
     *   '00001'   -> 7
     *   '000001'  -> 8
     *   '0000001' -> 9
     * @param string
     * @return int
     */
    private function codeToPolygon(string $code): int
    {
        $distance = strlen($code);
        return $distance === 4 ? 5 : $distance + 2;
    }

    /**
     * 出力形式に変換
     * @param int[] $polygons
     * @return string
     */
    private function format(array $polygons): string
    {
        sort($polygons);
        return implode('', $polygons);
    }
}
