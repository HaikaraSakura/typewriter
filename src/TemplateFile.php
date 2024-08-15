<?php

declare(strict_types=1);

namespace Haikara\Typewriter;

class TemplateFile
{
    /**
     * @var non-empty-string
     */
    protected string $path;

    public function __construct(string $path)
    {
        assert(str_ends_with($path, '.php'), 'テンプレートはPHPファイルである必要があります。');

        $this->path = $path;
    }

    public function __toString(): string
    {
        return $this->path;
    }
}
