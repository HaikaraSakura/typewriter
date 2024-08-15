<?php

declare(strict_types=1);

use Haikara\Typewriter\Typewriter;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$writer = new Typewriter();
$writer->setBasePath(__DIR__);

$writer->assign('title', 'タイトル');
$writer->assign('token', 'トークン');
$writer->assign('brand', 'ブランド');

echo $writer->render('header.php');