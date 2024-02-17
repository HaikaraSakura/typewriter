<?php

namespace Haikara\Typewriter;

class Typewriter implements TemplateEngineInterface
{
    protected BasePath $basePath;

    /**
     * @var array<string, mixed>
     */
    protected array $assigns = [];

    /**
     * @var ?ViewModelInterface
     */
    protected ?ViewModelInterface $viewModel;

    /**
     * @param string|BasePath $basePath
     * @return void
     */
    public function setBasePath(string|BasePath $basePath): void {
        $this->basePath = is_string($basePath) ? new BasePath($basePath) : $basePath;
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

    public function setViewModel(ViewModelInterface $viewModel): void {
        $this->viewModel = $viewModel;
    }

    /**
     * @param non-empty-string $filepath
     * @return string
     */
    public function render(string $filepath): string {
        $this->basePath ??= new BasePath('/');

        if (isset($this->viewModel)) {
            $this->viewModel->setBasePath($this->basePath);

            $outputBuffering = (function (string $filepath): void {
                require new TemplateFile($this->basePath, $filepath);
            })->bindTo($this->viewModel, $this->viewModel);
        } else {
            $view = new View();
            $view->setBasePath($this->basePath);

            $outputBuffering = (function (string $filepath, array $assigns): void {
                foreach ($assigns as $n => $v) {
                    $$n = $v;
                }

                require new TemplateFile($this->basePath, $filepath);
            })->bindTo($view, $view);
        }

        ob_start();
        $outputBuffering($filepath, $this->assigns);
        return ob_get_clean();
    }
}
