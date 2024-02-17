<?php

namespace Haikara\Typewriter\Tests;

use Haikara\Typewriter\ViewModel;

class SampleViewModel extends ViewModel
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $token;

    public function __construct(string $title, string $token) {
        $this->title = $title;
        $this->token = $token;
    }
}