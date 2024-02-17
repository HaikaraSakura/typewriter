<?php

declare(strict_types=1);

use Haikara\Typewriter\BasePath;
use Haikara\Typewriter\TemplateFile;
use Haikara\Typewriter\Typewriter;
use Haikara\Typewriter\View;
use PHPUnit\Framework\TestCase;

class TypewriterTest extends TestCase
{
    /**
     * @return void
     */
    public function testBaseDirectory()
    {
        $dir = new BasePath(__DIR__);
        self::assertSame((string)$dir, realpath(__DIR__ . '/../tests'));
        self::assertFileExists((string)$dir);
    }

    /**
     * TemplateFileクラスの正常系
     *
     * @return void
     */
    public function testTemplateFile()
    {
        $dir = new BasePath(__DIR__);

        $tpl = new TemplateFile($dir, 'view.php');
        self::assertSame((string)$tpl, realpath(__DIR__ . '/../tests/view.php'));
        self::assertFileExists((string)$tpl);

        $tpl = new TemplateFile($dir, 'view.php');
        self::assertSame((string)$tpl, realpath(__DIR__ . '/../tests/view.php'));
        self::assertFileExists((string)$tpl);
    }

    /**
     * インスタンス化の正常系
     *
     * @return void
     */
    public function testView()
    {
        $view = new View();

        $fn = (function () {
            return $this->esc("<script>alert('XSS')</script>");
        })->bindTo($view, $view);

        self::assertSame($fn(), htmlspecialchars("<script>alert('XSS')</script>", ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'));
    }
}
