<?php

declare(strict_types=1);

namespace Haikara\Typewriter;

interface TemplateEngineInterface
{
    /**
     * @param string|BasePath $basePath
     * @return void
     */
    public function setBasePath(string|BasePath $basePath): void;

    /**
     * @param ViewModelInterface $viewModel
     * @return void
     */
    public function setViewModel(ViewModelInterface $viewModel): void;

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function assign(string $name, mixed $value): void;

    /**
     * @param string $filepath
     * @return string
     */
    public function render(string $filepath): string;
}