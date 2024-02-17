<?php

declare(strict_types=1);

namespace Haikara\Typewriter;

use LogicException;

class TemplateFile
{
    /**
     * @var non-empty-string
     */
    protected string $path;

    public function __construct(BasePath $basePath, string $filepath)
    {
        if (!str_ends_with($filepath, '.php')) {
            throw new LogicException('テンプレートはPHPファイルである必要があります。');
        }

        $path = $basePath . '/' . ltrim($filepath, '/');
        $path = realpath($path);

        if ($path === false) {
            throw new LogicException('ファイルパスが不正です。');
        }

        $this->path = $path;
    }

    public function __toString(): string
    {
        return $this->path;
    }
}
