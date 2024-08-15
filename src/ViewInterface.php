<?php

declare(strict_types=1);

namespace Haikara\Typewriter;

interface ViewInterface
{
    /**
     * @param $value
     * @param int $flags
     * @param string $encoding
     * @param bool $doubleEncode
     * @return string
     */
    public static function esc(
        $value,
        int $flags = ENT_QUOTES|ENT_SUBSTITUTE,
        string $encoding = 'UTF-8',
        bool $doubleEncode = true
    ): string;

    /**
     * 別ファイルを読み込む。
     *
     * @param string $filepath
     * @param array $values
     * @return string
     */
    public function include(string $filepath, array $values = []): string;

    /**
     * フィルタ機能。第二引数以降に指定したcallableを左から順に適用して、値を返す。
     *
     * @param mixed $value
     * @param callable ...$callbacks
     * @return mixed
     */
    public static function filter(mixed $value, callable ...$callbacks): mixed;
}