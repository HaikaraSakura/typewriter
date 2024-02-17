<?php

declare(strict_types=1);

/**
 * @var ViewModelInterface $this
 */

use Haikara\Typewriter\ViewModelInterface;

?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p><?= $this->title ?></p>
<p><?= $this->token ?></p>
</body>
</html>
