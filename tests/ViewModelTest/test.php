<?php

declare(strict_types=1);

use Haikara\Typewriter\Tests\SampleViewModel;
use Haikara\Typewriter\Typewriter;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';

$writer = new Typewriter();
$writer->setBasePath(__DIR__);

$viewModel = new SampleViewModel('タイトル', 'トークン');

$writer->setViewModel($viewModel);

echo $writer->render('template.php');