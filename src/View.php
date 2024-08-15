<?php

namespace Haikara\Typewriter;

class View implements ViewInterface
{
    protected string $basePath = '/';

    protected array $assigns = [];

    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function assign(string $name, mixed $value): void
    {
        $this->assigns[$name] = $value;
    }

    /**
     * @inheritDoc
     */
    public function include(string $filepath, array $values = []): string {
        $engine = new Typewriter();
        $engine->setBasePath($this->basePath);

        foreach ($this->assigns as $name => $value) {
            $engine->assign($name, $value);
        }

        foreach ($values as $name => $value) {
            $engine->assign($name, $value);
        }

        return $engine->render($filepath);
    }

    /**
     * @inheritDoc
     */
    public static function esc(
        $value,
        int $flags = ENT_QUOTES|ENT_SUBSTITUTE,
        string $encoding = 'UTF-8',
        bool $doubleEncode = true
    ): string
    {
        $value = (string)filter_var($value);

        return htmlspecialchars($value, $flags, $encoding, $doubleEncode);
    }

    /**
     * @inheritDoc
     */
    public static function filter($value, callable ...$callbacks): mixed
    {
        foreach ($callbacks as $callback) {
            $value = $callback($value);
        }
        return $value;
    }
}