<?php

declare(strict_types=1);

namespace Haikara\Typewriter;

use LogicException;

class BasePath
{
    /**
     * @var string
     */
    protected string $path;

    public function __construct(string $path)
    {
        $path = realpath($path);

        if ($path === false || !is_dir($path)) {
            throw new LogicException($path . 'はディレクトリではありません。');
        }

        $this->path = $path;
    }

    public function __toString(): string
    {
        return $this->path;
    }
}
