<?php

namespace Haikara\Typewriter;

use LogicException;

class Typewriter
{
    protected string $basePath;

    /**
     * @var array<string, mixed>
     */
    protected array $assigns = [];

    /**
     * @var ViewInterface|null
     */
    protected ViewInterface|null $view;

    /**
     * @param string $basePath
     * @return void
     */
    public function setBasePath(string $basePath): void {
        assert(is_dir($basePath));

        $this->basePath = realpath($basePath);
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

    public function setView(ViewInterface $view): void {
        $this->view = $view;
    }

    /**
     * @param non-empty-string $filepath
     * @return string
     */
    public function render(string $filepath): string {
        $this->basePath ??= '/';

        $path = $this->basePath . '/' . ltrim($filepath, './');
        $path = realpath($path);

        if ($path === false || !is_file($path)) {
            throw new LogicException('ファイルパスが不正です。');
        }

        if (isset($this->view)) {
            $view = $this->view;

            $outputBuffering = function (string $path): void {
                require new TemplateFile($path);
            };
        } else {
            $view = new View();

            $outputBuffering = function (string $path, array $assigns): void {
                foreach ($assigns as $name => $value) {
                    $$name = $value;
                }

                require new TemplateFile($path);
            };
        }

        foreach ($this->assigns as $name => $value) {
            $view->assign($name, $value);
        }

        $outputBuffering = $outputBuffering->bindTo($view, $view);
        $view->setBasePath($this->basePath);

        ob_start();
        $outputBuffering($path, $this->assigns);
        return ob_get_clean();
    }
}
