<?php

use Haikara\Typewriter\ViewInterface;

/**
 * @var ViewInterface $this
 * @var string $title
 * @var string $token
 */

?>

<header>
    <span>
        <?= $this->esc($title) ?>
    </span>
</header>

<p><?= $this->esc($token) ?></p>

<p><?= $this->esc($message ?? '変数$messageは登録されていません。') ?></p>

<?= $this->include('brand.php') ?>