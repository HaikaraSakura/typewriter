<?php

namespace Haikara\Typewriter;

abstract class ViewModel implements ViewModelInterface
{
    /**
     * @var BasePath
     */
    public BasePath $basePath;

    public function setBasePath(BasePath $basePath): void
    {
        $this->basePath = $basePath;
    }

    /**
     * @inheritDoc
     */
    public function include(string $filepath, array $values = []): string {
        $engine = new Typewriter();
        $engine->setBasePath($this->basePath);

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